@extends('layouts.app')

@section('title', 'Chat dengan Penjual | AuraGlow')

@section('content')
<div class="bg-rose-50/10 py-12 min-h-[calc(100vh-80px)]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-sm border border-rose-100 flex flex-col h-[600px] overflow-hidden">
            <!-- Header -->
            <div class="bg-pink-500 p-4 flex items-center justify-between text-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center font-bold">
                        AG
                    </div>
                    <div>
                        <h2 class="font-medium text-lg border-rose-100">AuraGlow Admin</h2>
                        <p class="text-xs text-pink-100 flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-green-400"></span> Online</p>
                    </div>
                </div>
            </div>

            <!-- Messages Area -->
            <div id="chat-messages" class="flex-1 p-6 overflow-y-auto bg-slate-50 space-y-4 custom-scrollbar">
                <!-- Messages will be loaded here -->
                <div class="flex justify-center text-xs text-zinc-400 my-4">Memuat pesan...</div>
            </div>

            <!-- Input Area -->
            <form id="chat-form" class="p-4 bg-white border-t border-rose-100 flex gap-2" onsubmit="sendMessage(event)">
                <input type="text" id="chat-input" value="{{ $initialMessage }}" placeholder="Ketik pesan Anda..." class="flex-1 border border-rose-200 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent">
                <button type="submit" class="bg-pink-500 text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-pink-600 transition shadow-sm">
                    <svg class="w-5 h-5 -ml-1 mt-1" fill="currentColor" viewBox="0 0 24 24"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path></svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const chatMessages = document.getElementById('chat-messages');
    let lastMessageId = 0;

    function fetchMessages() {
        fetch('{{ route("chat.fetch") }}')
            .then(res => res.json())
            .then(data => {
                if (data.length > 0) {
                    let latestId = data[data.length - 1].id;
                    if (latestId > lastMessageId) {
                        chatMessages.innerHTML = '';
                        data.forEach(msg => {
                            const isUser = msg.sender_type === 'user';
                            const date = new Date(msg.created_at);
                            const time = ("0" + date.getHours()).slice(-2) + ":" + ("0" + date.getMinutes()).slice(-2);
                            
                            const msgHtml = `
                                <div class="flex ${isUser ? 'justify-end' : 'justify-start'}">
                                    <div class="max-w-[75%] rounded-2xl px-4 py-2 text-sm shadow-sm ${isUser ? 'bg-pink-500 text-white rounded-br-none' : 'bg-white text-zinc-800 border border-rose-100 rounded-bl-none'}">
                                        <p>${msg.message}</p>
                                        <span class="text-[10px] ${isUser ? 'text-pink-100' : 'text-zinc-400'} float-right mt-1 ml-3">${time}</span>
                                    </div>
                                </div>
                            `;
                            chatMessages.insertAdjacentHTML('beforeend', msgHtml);
                        });
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                        lastMessageId = latestId;
                    }
                } else {
                    chatMessages.innerHTML = '<div class="flex justify-center text-xs text-zinc-400 my-4">Belum ada obrolan. Silakan kirim pesan.</div>';
                }
            })
            .catch(err => console.error(err));
    }

    function sendMessage(e) {
        e.preventDefault();
        let input = document.getElementById('chat-input');
        let message = input.value.trim();
        if (!message) return;

        input.value = '';
        
        fetch('{{ route("chat.send") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: message })
        }).then(() => fetchMessages());
    }

    fetchMessages();
    setInterval(fetchMessages, 3000);
</script>
@endsection
