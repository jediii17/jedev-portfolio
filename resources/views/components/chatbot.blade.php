{{-- Floating Chatbot Widget --}}
<div x-data="chatbot()" x-cloak class="fixed bottom-6 right-6 z-50">
    {{-- Chat Window --}}
    <div
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-8"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-8"
        class="absolute bottom-20 right-0 w-72 sm:w-85 bg-surface/80 backdrop-blur-xl border border-white/20 dark:border-white/10 rounded-xl shadow-[0_20px_50px_rgba(0,0,0,0.3)] overflow-hidden z-50">

        {{-- Animated Gradient Background Layer --}}
        <div class="absolute inset-0 opacity-20 pointer-events-none mesh-gradient"></div>

        {{-- Header --}}
        <div class="relative bg-linear-to-r from-accent via-accent/90 to-accent-hover px-5 py-4 flex items-center justify-between shadow-lg">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="w-10 h-10 rounded-full bg-white backdrop-blur-md p-0.5 border border-white/30 overflow-hidden shadow-inner">
                        <img src="{{ Vite::asset('resources/js/assets/images/profile.png') }}" alt="Jed" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full bg-green-500 border-2 border-accent animate-pulse"></div>
                </div>
                <div>
                    <h3 class="text-white font-bold text-sm tracking-tight">Jedidia Lemuel Cruz</h3>
                    <span class="text-white/80 text-[10px] uppercase tracking-widest font-medium">Online</span>
                </div>
            </div>
            <button @click="isOpen = false" class="p-2 rounded-full hover:bg-white/10 text-white/70 hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        {{-- Messages Container --}}
        <div
            x-ref="messagesContainer"
            class="relative h-96 overflow-y-auto p-5 space-y-5 flex flex-col custom-scrollbar">
            {{-- Spacing helper to push messages to bottom --}}
            <div class="grow"></div>

            {{-- Chat Messages --}}
            <template x-for="(message, index) in messages" :key="index">
                <div :class="message.role === 'user' ? 'flex justify-end pr-2' : 'flex justify-start items-end gap-3 pl-1'">
                    <template x-if="message.role !== 'user'">
                        <div class="shrink-0 mb-1">
                            <img src="{{ Vite::asset('resources/js/assets/images/profile.png') }}" alt="Jed" class="w-8 h-8 rounded-full border border-accent/20 shadow-sm">
                        </div>
                    </template>

                    <div
                        :class="[
                            message.role === 'user'
                                ? 'bg-accent text-white rounded-2xl rounded-br-none chat-bubble-user shadow-[0_4px_15px_rgba(59,130,246,0.3)]'
                                : '',
                            message.role === 'assistant' && !message.is_admin
                                ? 'bg-surface/90 text-primary border border-white/20 dark:border-white/5 rounded-2xl rounded-bl-none chat-bubble-ai shadow-sm backdrop-blur-md'
                                : '',
                            message.is_admin
                                ? 'bg-surface text-primary border-2 border-accent/40 rounded-2xl rounded-bl-none chat-bubble-admin shadow-md backdrop-blur-md'
                                : ''
                        ]"
                        class="px-4 py-3 text-sm max-w-[85%] relative group transition-all duration-300">

                        {{-- Name inside bubble for Assistant/Admin --}}
                        <template x-if="message.role !== 'user'">
                            <div class="flex items-center gap-2 mb-1.5 leading-tight">
                                <span class="text-[11px] font-extrabold text-accent uppercase tracking-tighter">Jedidia Lemuel Cruz</span>
                                <template x-if="message.is_admin">
                                    <span class="text-[8px] bg-accent/20 text-accent px-2 py-0.5 rounded-full uppercase tracking-widest font-black border border-accent/20">Direct</span>
                                </template>
                            </div>
                        </template>

                        <div class="pr-2">
                            <p x-html="formatMessage(message.content)" class="whitespace-pre-wrap wrap-break-words leading-relaxed font-normal"></p>
                        </div>

                        {{-- Micro timestamp style --}}
                        <div class="text-[9px] text-right mt-1.5 opacity-40 font-medium tracking-tighter select-none">
                            <span x-text="new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })"></span>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Typing Indicator --}}
            <div x-show="isLoading" class="flex justify-start items-end gap-3 pl-1">
                <img src="{{ Vite::asset('resources/js/assets/images/profile.png') }}" alt="Jed" class="w-8 h-8 rounded-full border border-accent/20">
                <div class="bg-surface/90 border border-white/20 rounded-2xl rounded-bl-none px-5 py-4 shadow-sm chat-bubble-ai backdrop-blur-md">
                    <div class="flex gap-1.5 Items-center">
                        <span class="w-1.5 h-1.5 bg-accent rounded-full animate-bounce" style="animation-delay: 0ms"></span>
                        <span class="w-1.5 h-1.5 bg-accent rounded-full animate-bounce" style="animation-delay: 150ms"></span>
                        <span class="w-1.5 h-1.5 bg-accent rounded-full animate-bounce" style="animation-delay: 300ms"></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Input Area --}}
        <div class="relative p-4 bg-surface/50 backdrop-blur-xl border-t border-white/10">
            {{-- Emoji Picker Panel --}}
            <div
                x-show="showEmojiPicker"
                @click.away="showEmojiPicker = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                class="absolute bottom-full left-4 mb-4 p-3 bg-surface/95 backdrop-blur-2xl border border-white/20 rounded-2xl shadow-2xl w-72 z-60 grid-container">
                <div class="text-[10px] font-bold text-muted uppercase tracking-widest mb-2 px-1">Frequent Emojis</div>
                <div class="grid grid-cols-8 gap-1.5">
                    <template x-for="emoji in commonEmojis" :key="emoji">
                        <button
                            @click="addEmoji(emoji)"
                            type="button"
                            class="w-7.5 h-7.5 flex items-center justify-center text-lg hover:bg-accent/10 rounded-lg transition-all active:scale-90"
                            x-text="emoji">
                        </button>
                    </template>
                </div>
            </div>

            <form @submit.prevent="sendMessage" class="flex items-center gap-3">
                <div class="flex-1 relative group">
                    <button
                        @click="showEmojiPicker = !showEmojiPicker"
                        type="button"
                        class="absolute left-2 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center text-muted hover:text-accent hover:bg-accent/5 rounded-full transition-all z-10 active:scale-90"
                        title="Add Emoji">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </button>
                    <input
                        x-model="userInput"
                        x-ref="messageInput"
                        type="text"
                        placeholder="Say something..."
                        class="w-full pl-11 pr-14 py-3 text-sm bg-page/40 border border-white/10 rounded-2xl focus:outline-none focus:ring-2 focus:ring-accent/30 focus:border-accent/30 text-primary placeholder-muted transition-all"
                        :disabled="isLoading"
                        maxlength="500">
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-[9px] text-muted/60 font-mono font-bold" x-text="userInput.length"></div>
                </div>
                <button
                    type="submit"
                    class="w-12 h-12 flex items-center justify-center bg-linear-to-tr from-accent to-accent-hover text-white rounded-2xl shadow-[0_4px_15px_rgba(59,130,246,0.3)] hover:shadow-[0_8px_20px_rgba(59,130,246,0.4)] transition-all active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed shrink-0"
                    :disabled="isLoading || !userInput.trim()">
                    <svg class="w-6 h-6 translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </form>
        </div>

        <div class="px-5 py-2 bg-accent/5 text-center">
            <p class="text-accent/60 text-[10px] uppercase tracking-tighter font-bold">Ask me about my experience, skills and projects.</p>
        </div>
    </div>

    {{-- Toggle Button --}}
    <button
        @click="isOpen = !isOpen"
        class="relative h-14 pl-4 pr-5 rounded-full bg-surface/90 backdrop-blur-md border border-accent/20 text-primary shadow-[0_10px_30px_rgba(0,0,0,0.1)] hover:shadow-[0_15px_40px_rgba(59,130,246,0.2)] transition-all duration-500 flex items-center gap-3 group overflow-hidden z-60"
        :class="isOpen ? '' : 'animate-float-subtle'">

        {{-- Animated Gradient Background for Button --}}
        <div class="absolute inset-0 bg-linear-to-tr from-accent/5 to-accent-hover/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>

        <div class="relative w-8 h-8 rounded-full bg-accent flex items-center justify-center text-white shadow-[0_4px_10px_rgba(59,130,246,0.4)] group-hover:scale-110 transition-transform duration-500">
            <svg x-show="!isOpen" class="w-5 h-5 transition-transform duration-500 group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            <svg x-show="isOpen" class="w-5 h-5 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
        <span class="relative text-sm font-bold tracking-tight text-primary">Chat with Jed</span>

        {{-- Online Pulse --}}
        <div x-show="!isOpen" class="absolute top-3 left-10 w-2 h-2 rounded-full bg-green-500 border-2 border-surface animate-pulse"></div>
    </button>
</div>

@push('scripts')
<script>
    function chatbot() {
        return {
            isOpen: false,
            isLoading: false,
            userInput: '',
            messages: [],
            currentChatId: null,
            pollingInterval: null,
            showEmojiPicker: false,
            commonEmojis: ['😊', '😂', '😍', '🤔', '😎', '🎸', '🔥', '🚀', '💻', '🎨', '✨', '👋', '🤘', '👍', '🙏', '❤️', '📍', '💡', '✅', '❌', '🎬', '🏆', '🎉', '🌟', '⚙️', '📱', '📬', '☕', '🍕', '🍻', '🌈', '⚡'],

            init() {
                this.$watch('isOpen', (value) => {
                    if (value && this.messages.length === 0 && !this.isLoading) {
                        this.isLoading = true;

                        setTimeout(() => {
                            this.messages.push({
                                role: 'assistant',
                                content: "Hi there! I'm **Jed**. Thanks for stopping by! Feel free to ask me anything about my projects, skills, or experience. I'm here to help you get to know my work better! 🎸"
                            });
                            this.isLoading = false;
                            this.$nextTick(() => this.scrollToBottom());
                        }, 1500);
                    }
                });
            },

            addEmoji(emoji) {
                this.userInput += emoji;
                this.showEmojiPicker = false;
                this.$refs.messageInput.focus();
            },

            async sendMessage() {
                if (!this.userInput.trim() || this.isLoading) return;

                const userMessage = this.userInput.trim();
                this.userInput = '';
                this.messages.push({
                    role: 'user',
                    content: userMessage
                });

                this.$nextTick(() => this.scrollToBottom());

                this.isLoading = true;

                // Stop any previous polling
                this.stopPolling();

                try {
                    const response = await fetch('/api/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            message: userMessage
                        }),
                    });

                    if (!response.ok) {
                        throw new Error('I am likely playing guitar right now! 🙈 Try again in a bit');
                    }

                    const data = await response.json();

                    if (data.success) {
                        this.messages.push({
                            role: 'assistant',
                            content: data.message
                        });

                        // Store chat ID and start polling for admin replies
                        if (data.chat_id) {
                            this.currentChatId = data.chat_id;
                            this.startPolling();
                        }
                    } else {
                        this.messages.push({
                            role: 'assistant',
                            content: data.message || 'Sorry, something went wrong. Please try again.'
                        });
                    }
                } catch (error) {
                    console.error('Chat error:', error);
                    this.messages.push({
                        role: 'assistant',
                        content: 'I am likely playing guitar right now!🎶 Try again in a bit'
                    });
                } finally {
                    this.isLoading = false;
                    this.$nextTick(() => this.scrollToBottom());
                }
            },

            startPolling() {
                if (this.pollingInterval) return;

                // Poll every 5 seconds for admin replies
                this.pollingInterval = setInterval(async () => {
                    if (!this.currentChatId) return;

                    try {
                        const response = await fetch(`/api/chat/reply?chat_id=${this.currentChatId}`, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                            },
                        });

                        const data = await response.json();

                        if (data.success && data.has_reply) {
                            this.messages.push({
                                role: 'assistant',
                                content: data.admin_reply,
                                is_admin: true
                            });

                            // Stop polling after receiving a reply or keep it going if multiple replies are expected?
                            // For now, let's stop polling once we get one reply to keep it clean.
                            this.stopPolling();
                            this.$nextTick(() => this.scrollToBottom());
                        }
                    } catch (error) {
                        console.error('Polling error:', error);
                    }
                }, 5000);
            },

            stopPolling() {
                if (this.pollingInterval) {
                    clearInterval(this.pollingInterval);
                    this.pollingInterval = null;
                }
            },

            scrollToBottom() {
                const container = this.$refs.messagesContainer;
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            },

            formatMessage(content) {
                if (!content) return '';
                // Basic markdown-like formatting
                return content
                    .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                    .replace(/\*(.*?)\*/g, '<em>$1</em>')
                    .replace(/`(.*?)`/g, '<code class="bg-page px-1 rounded text-xs">$1</code>')
                    .replace(/\n/g, '<br>');
            }
        }
    }
</script>

<style>
    [x-cloak] {
        display: none !important;
    }

    /* Modern Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 5px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(var(--color-accent-rgb, 59, 130, 246), 0.2);
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(var(--color-accent-rgb, 59, 130, 246), 0.4);
    }

    /* Animated Mesh Gradient */
    .mesh-gradient {
        background-color: var(--color-accent);
        background-image:
            radial-gradient(at 0% 0%, hsla(225, 100%, 77%, 1) 0, transparent 50%),
            radial-gradient(at 50% 0%, hsla(225, 100%, 70%, 1) 0, transparent 50%),
            radial-gradient(at 100% 0%, hsla(225, 100%, 77%, 1) 0, transparent 50%);
        background-size: 200% 200%;
        animation: mesh-flow 10s ease infinite;
    }

    @keyframes mesh-flow {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    /* Floating Animation for Button */
    @keyframes float-subtle {

        0%,
        100% {
            transform: translateY(0) scale(1);
        }

        50% {
            transform: translateY(-8px) scale(1.02);
        }
    }

    .animate-float-subtle {
        animation: float-subtle 4s ease-in-out infinite;
    }

    /* Message Tails (Refined for 3xl) */
    .chat-bubble-user::after {
        content: '';
        position: absolute;
        bottom: 0px;
        right: -6px;
        width: 12px;
        height: 12px;
        background-color: var(--color-accent);
        clip-path: polygon(0 0, 0% 100%, 100% 100%);
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
    }

    .chat-bubble-ai::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: -6px;
        width: 12px;
        height: 12px;
        background-color: var(--bg-secondary);
        /* Matches surface/90 approx */
        clip-path: polygon(100% 0, 0 100%, 100% 100%);
        backdrop-filter: blur(12px);
    }

    .chat-bubble-admin::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: -6px;
        width: 12px;
        height: 12px;
        background-color: var(--bg-secondary);
        border-left: 2px solid rgba(var(--color-accent-rgb, 59, 130, 246), 0.3);
        border-bottom: 2px solid rgba(var(--color-accent-rgb, 59, 130, 246), 0.3);
        clip-path: polygon(100% 0, 0 100%, 100% 100%);
    }

    .chat-bubble-admin::before {
        content: '';
        position: absolute;
        bottom: -2px;
        left: -7px;
        width: 13px;
        height: 13px;
        background-color: rgba(var(--color-accent-rgb, 59, 130, 246), 0.3);
        z-index: -1;
        clip-path: polygon(100% 0, 0 100%, 100% 100%);
    }
</style>
@endpush