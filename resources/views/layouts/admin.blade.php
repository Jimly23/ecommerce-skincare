<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - AuraGlow')</title>
    <!-- Fallback CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        rose: { 50: '#fff1f2', 100: '#ffe4e6', 200: '#fecdd3' },
                        pink: { 400: '#f472b6', 500: '#ec4899', 600: '#db2777' },
                        zinc: { 50: '#fafafa', 100: '#f4f4f5', 200: '#e4e4e7', 400: '#a1a1aa', 500: '#71717a', 600: '#52525b', 800: '#27272a', 900: '#18181b' }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@hotwired/turbo@8.0.4/dist/turbo.es2017-umd.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-rose-50/20 text-zinc-800 antialiased font-light flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-rose-100 flex flex-col">
        <div class="h-20 flex items-center px-6 border-b border-rose-100/50">
            <a href="{{ route('admin.dashboard') }}" class="text-2xl font-semibold tracking-widest text-zinc-800">
                Admin<span class="text-pink-500">Panel</span>
            </a>
        </div>
        <nav class="flex-grow p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition 
                {{ request()->routeIs('admin.dashboard') ? 'bg-pink-500 text-white' : 'text-zinc-600 hover:bg-rose-50 hover:text-pink-500' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition 
                {{ request()->routeIs('admin.products.*') ? 'bg-pink-500 text-white' : 'text-zinc-600 hover:bg-rose-50 hover:text-pink-500' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <span class="font-medium">Products</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition 
                {{ request()->routeIs('admin.orders.*') ? 'bg-pink-500 text-white' : 'text-zinc-600 hover:bg-rose-50 hover:text-pink-500' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                <span class="font-medium">Daftar Pesanan</span>
            </a>
            <a href="{{ route('admin.chat.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition 
                {{ request()->routeIs('admin.chat.*') ? 'bg-pink-500 text-white' : 'text-zinc-600 hover:bg-rose-50 hover:text-pink-500' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                <span class="font-medium">Pesan Pelanggan</span>
                @php
                    $unreadChats = \App\Models\Message::where('sender_type', 'user')->where('is_read', false)->count();
                @endphp
                @if($unreadChats > 0)
                    <span class="ml-auto bg-pink-500 text-white text-[10px] w-5 h-5 flex items-center justify-center rounded-full">{{ $unreadChats }}</span>
                @endif
            </a>
        </nav>
        <div class="p-4 border-t border-rose-100">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 transition border border-transparent hover:border-red-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col overflow-hidden">
        <!-- Topbar -->
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-rose-100 px-8 flex items-center justify-between">
            <h2 class="text-xl font-medium text-zinc-800">@yield('header_title')</h2>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 rounded-full bg-pink-100 text-pink-500 flex items-center justify-center font-bold">
                        {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                    </div>
                    <div class="hidden md:block">
                        <p class="text-sm font-medium text-zinc-800">{{ Auth::guard('admin')->user()->name }}</p>
                        <p class="text-xs text-zinc-500">Administrator</p>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Content Area -->
        <div class="flex-grow p-8 overflow-y-auto">
            @if(session('success'))
                <div class="bg-green-50 text-green-600 p-4 rounded-xl mb-6 border border-green-200">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </div>
    </main>
</body>
</html>
