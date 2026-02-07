import { createClient } from "https://esm.sh/@supabase/supabase-js@2";

Deno.serve(async (req) => {
  const BOT_TOKEN = Deno.env.get("BOT_TOKEN");
  const MY_CHAT_ID = Deno.env.get("MY_CHAT_ID");
  const supabaseUrl = Deno.env.get("SUPABASE_URL");
  const supabaseKey = Deno.env.get("SUPABASE_SERVICE_ROLE_KEY");

  const supabase = createClient(supabaseUrl!, supabaseKey!);

  try {
    const body = await req.json();

    // 1. Handle Button Clicks (Delete & Block)
    if (body.callback_query) {
      const callbackData = body.callback_query.data;
      const chatId = body.callback_query.message.chat.id;
      const messageId = body.callback_query.message.message_id;

      // Handle DELETE
      if (callbackData.startsWith("delete_")) {
        const logId = callbackData.split("_")[1];

        await supabase.from("chat_logs").delete().eq("id", logId);
        await fetch(`https://api.telegram.org/bot${BOT_TOKEN}/editMessageText`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            chat_id: chatId,
            message_id: messageId,
            text: `🗑️ *Log #${logId} deleted.*`,
            parse_mode: "Markdown",
          }),
        });
      }

      // Handle BLOCK
      if (callbackData.startsWith("block_")) {
        const ip = callbackData.split("_")[1];

        await supabase.from("blocked_ips").insert({ ip_address: ip });
        await fetch(`https://api.telegram.org/bot${BOT_TOKEN}/editMessageText`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            chat_id: chatId,
            message_id: messageId,
            text: `🚫 *IP Address ${ip} has been banned.*`,
            parse_mode: "Markdown",
          }),
        });
      }

      return new Response("OK", { status: 200 });
    }

    // 2. Handle Telegram Admin Reply (from direct message or channel)
    const incomingMessage = body.message || body.channel_post;
    
    // Log incoming message for debugging
    if (incomingMessage) {
      console.log("Incoming Telegram Message:", JSON.stringify(body, null, 2));
    }

    if (incomingMessage && !body.type) { // If it has a message/post but no body.type (which comes from Supabase webhooks)
      console.log("Processing Telegram Update:", JSON.stringify(body, null, 2));
      
      const incomingChatId = String(incomingMessage.chat.id);
      const incomingFromId = String(incomingMessage.from?.id || "");
      const incomingSenderChatId = String(incomingMessage.sender_chat?.id || "");
      const text = incomingMessage.text;

      console.log(`Matching details: 
        Chat ID: ${incomingChatId} 
        From ID: ${incomingFromId} 
        Sender Chat ID: ${incomingSenderChatId} 
        MY_CHAT_ID: ${MY_CHAT_ID}`);

      // Check if it matches our admin ID (Incoming chat ID or the sender's ID or the channel's ID)
      const isMatch = [incomingChatId, incomingFromId, incomingSenderChatId].includes(MY_CHAT_ID) || 
                      (MY_CHAT_ID.startsWith('-100') && incomingChatId === MY_CHAT_ID.replace('-100', '')) ||
                      (MY_CHAT_ID.replace('-100', '') === incomingChatId);

      if (isMatch && text) {
        console.log("Admin match found. Looking for latest chat log...");
        const { data: latestChat, error: queryError } = await supabase
          .from("chat_logs")
          .select("*")
          .is("admin_reply", null)
          .eq("is_replied", false)
          .order("created_at", { ascending: false })
          .limit(1)
          .single();

        if (queryError) console.error("Query Error:", queryError);

        if (latestChat) {
          console.log(`Replying to chat log ID: ${latestChat.id}`);
          const { error: updateError } = await supabase
            .from("chat_logs")
            .update({
              admin_reply: text,
              is_replied: true,
            })
            .eq("id", latestChat.id);

          if (updateError) console.error("Update Error:", updateError);

          await fetch(`https://api.telegram.org/bot${BOT_TOKEN}/sendMessage`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
              chat_id: incomingChatId,
              text: `✅ *REPLY SENT* to log #${latestChat.id}`,
              parse_mode: "Markdown",
            }),
          });
        } else {
          console.log("No pending chat logs found to reply to.");
        }
        return new Response("OK", { status: 200 });
      } else {
        console.log("No valid admin match or no text found.");
      }
    }

    // 3. Handle New User Message (Webhook from Supabase INSERT)
    if (body.type === "INSERT") {
      const record = body.record;
      console.log("Processing Supabase INSERT webhook for record:", record.id);

      // SPAM CHECK: Check if IP is blocked
      const { data: isBlocked } = await supabase
        .from("blocked_ips")
        .select("ip_address")
        .eq("ip_address", record.ip_address)
        .single();

      if (isBlocked) {
        // Silently delete the message and stop
        await supabase.from("chat_logs").delete().eq("id", record.id);
        return new Response("Blocked", { status: 200 });
      }

      // Send notification to Telegram
      const messageContent = `
📩 *New Portfolio Message for Jed*

👤 *From:* \`${record.ip_address || "Unknown"}\`
🕒 *Time:* ${new Date(record.created_at).toLocaleString('en-US', { hour12: true, timeZone: "Asia/Manila" })}

💬 *Message:*
${record.user_message}

🤖 *AI Response:*
${record.ai_response || "N/A"}
      `.trim();

      await fetch(`https://api.telegram.org/bot${BOT_TOKEN}/sendMessage`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          chat_id: MY_CHAT_ID,
          text: messageContent,
          parse_mode: "Markdown",
          reply_markup: {
            inline_keyboard: [
              [
                { text: "🗑️ Delete", callback_data: `delete_${record.id}` },
                { text: "🚫 Block IP", callback_data: `block_${record.ip_address}` },
              ],
            ],
          },
        }),
      });

      return new Response("OK", { status: 200 });
    }

    return new Response("No action taken", { status: 200 });
  } catch (error) {
    console.error("Global Catch Error:", error);
    return new Response(JSON.stringify({ error: error.message }), { 
      status: 200, // Returning 200 to prevent Telegram from retrying on logical errors
      headers: { "Content-Type": "application/json" } 
    });
  }
});
