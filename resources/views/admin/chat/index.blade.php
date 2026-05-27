@extends('layouts.admin')

@section('title', 'Pesan Pelanggan')
@section('header_title', 'Pesan Pelanggan')

@section('content')
<div class="bg-white rounded-2xl border border-rose-100 shadow-sm overflow-hidden h-[calc(100vh-160px)] flex">
    
    <!-- User List -->
    <div class="w-1/3 border-r border-rose-100 flex flex-col bg-slate-50">
        <div class="p-4 border-b border-rose-100 bg-white">
            <h3 class="font-medium text-zinc-800">Daftar Obrolan</h3>
        </div>
        <div class="flex-1 overflow-y-auto">
            @forelse($users as $u)
                @php 
                    $latestMsg = $u->messages->first(); 
                    $unread = $u->messages->where('sender_type', 'user')->where('is_read', false)->count();
                @endphp
                <a href="{{ route('admin.chat.show', $u->id) }}" class="block p-4 border-b border-rose-50 hover:bg-rose-50 transition">
                    <div class="flex justify-between items-start mb-1">
                        <h4 class="font-medium text-sm text-zinc-800">{{ $u->name }}</h4>
                        <span class="text-[10px] text-zinc-400">{{ $latestMsg->created_at->format('H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="text-xs text-zinc-500 font-light truncate max-w-[80%]">{{ $latestMsg->sender_type == 'admin' ? 'Anda: ' : '' }}{{ $latestMsg->message }}</p>
                        @if($unread > 0)
                            <span class="bg-pink-500 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full">{{ $unread }}</span>
                        @endif
                    </div>
                </a>
            @empty
                <div class="p-4 text-center text-sm text-zinc-500">Belum ada pesan.</div>
            @endforelse
        </div>
    </div>

    <!-- Chat Area Placeholder -->
    <div class="w-2/3 flex flex-col items-center justify-center bg-zinc-50">
        <svg class="w-16 h-16 text-zinc-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
        <p class="text-zinc-500 font-light">Pilih obrolan dari daftar untuk berinteraksi</p>
    </div>
</div>

<script>
    // Simple auto refresh for new messages count on the index
    setInterval(() => {
        location.reload();
    }, 15000);
</script>
@endsection
