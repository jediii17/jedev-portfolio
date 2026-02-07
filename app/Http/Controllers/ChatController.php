<?php

namespace App\Http\Controllers;

use App\Ai\Agents\PortfolioChatbot;
use App\Models\ChatLog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    /**
     * Handle chatbot message and return AI response.
     */
    public function chat(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        try {
            $chatbot = new PortfolioChatbot();
            $response = $chatbot->prompt($request->message);

            // Log the conversation to the database
            $chatLog = ChatLog::create([
                'user_message' => $request->message,
                'ai_response' => (string) $response,
                'ip_address' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => (string) $response,
                'chat_id' => $chatLog->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Chatbot error: ' . $e->getMessage());

            // Log failed attempt if needed, or at least the user message
            $chatLog = ChatLog::create([
                'user_message' => $request->message,
                'ip_address' => $request->ip(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'I am likely playing guitar right now! 🎸 Try again in a bit',
                'error' => config('app.debug') ? $e->getMessage() : null,
                'chat_id' => $chatLog->id ?? null,
            ], 500);
        }
    }

    /**
     * Check if there's an admin reply for a specific chat.
     */
    public function getAdminReply(Request $request): JsonResponse
    {
        $request->validate([
            'chat_id' => 'required|integer',
        ]);

        $chatLog = ChatLog::find($request->chat_id);

        if (!$chatLog) {
            return response()->json([
                'success' => false,
                'message' => 'Chat not found.',
            ], 404);
        }

        if ($chatLog->is_replied && $chatLog->admin_reply) {
            return response()->json([
                'success' => true,
                'has_reply' => true,
                'admin_reply' => $chatLog->admin_reply,
            ]);
        }

        return response()->json([
            'success' => true,
            'has_reply' => false,
        ]);
    }
}
