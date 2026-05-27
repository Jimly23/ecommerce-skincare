@extends('layouts.admin')

@section('title', 'Chat dengan ' . $user->name)
@section('header_title', 'Chat Pelanggan')

@section('content')
<div class="bg-white rounded-2xl border border-rose-100 shadow-sm overflow-hidden h-[calc(100vh-160px)] flex flex-col">
    <!-- Header -->
    <div class="p-4 border-b border-rose-100 flex items-center justify-between bg-white">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.chat.index') }}" class="w-8 h-8 rounded-lg bg-white border border-rose-200 flex items-center justify-center text-zinc-500 hover:text-pink-500 hover:border-pink-300 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h3 class="font-medium text-zinc-800">{{ $user->name }}</h3>
                <p class="text-xs text-zinc-500">{{ $user->email }}</p>
            </div>
        </div>
    </div>

    <!-- Messages -->
    <div id="admin-chat-messages" class="flex-1 p-6 overflow-y-auto bg-slate-50 space-y-4 custom-scrollbar">
        <!-- Loaded via JS -->
    </div>

    <!-- Input -->
    <form id="admin-chat-form" class="p-4 border-t border-rose-100 bg-white flex gap-2" onsubmit="sendAdminMessage(event)">
        <input type="text" id="admin-chat-input" placeholder="Tulis balasan Anda..." class="flex-1 border border-rose-200 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
        <button type="submit" class="bg-pink-500 text-white px-6 rounded-full font-medium text-sm hover:bg-pink-600 transition shadow-sm">Kirim</button>
    </form>
</div>

<script>
    const chatContainer = document.getElementById('admin-chat-messages');
    let lastMsgId = 0;

    function fetchAdminMessages() {
        fetch('/admin/chat/{{ $user->id }}/fetch')
            .then(res => res.json())
            .then(data => {
                if (data.length > 0) {
                    let latest = data[data.length - 1].id;
                    if (latest > lastMsgId) {
                        chatContainer.innerHTML = '';
                        data.forEach(msg => {
                            const isAdmin = msg.sender_type === 'admin';
                            const date = new Date(msg.created_at);
                            const time = ("0" + date.getHours()).slice(-2) + ":" + ("0" + date.getMinutes()).slice(-2);
                            
                            const msgHtml = `
                                <div class="flex ${isAdmin ? 'justify-end' : 'justify-start'}">
                                    <div class="max-w-[70%] rounded-2xl px-4 py-2 text-sm shadow-sm ${isAdmin ? 'bg-pink-500 text-white rounded-br-none' : 'bg-white text-zinc-800 border border-rose-100 rounded-bl-none'}">
                                        <p>${msg.message}</p>
                                        <span class="text-[10px] ${isAdmin ? 'text-pink-100' : 'text-zinc-400'} float-right mt-1 ml-3">${time}</span>
                                    </div>
                                </div>
                            `;
                            chatContainer.insertAdjacentHTML('beforeend', msgHtml);
                        });
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                        lastMsgId = latest;
                    }
                }
            });
    }

    function sendAdminMessage(e) {
        e.preventDefault();
        let input = document.getElementById('admin-chat-input');
        let text = input.value.trim();
        if(!text) return;
        
        input.value = '';
        fetch('/admin/chat/{{ $user->id }}/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: text })
        }).then(() => fetchAdminMessages());
    }

    fetchAdminMessages();
    setInterval(fetchAdminMessages, 3000); // poll every 3 sec
</script>
@endsection
