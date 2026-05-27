<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AuraGlow | Kosmetik Mewah')</title>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <!-- Fallback CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Konfigurasi warna tailwind agar sesuai dengan utility standard saat menggunakan CDN -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        rose: {
                            50: '#fff1f2',
                            100: '#ffe4e6',
                            200: '#fecdd3',
                        },
                        pink: {
                            400: '#f472b6',
                            500: '#ec4899',
                            600: '#db2777',
                        },
                        zinc: {
                            50: '#fafafa',
                            100: '#f4f4f5',
                            200: '#e4e4e7',
                            400: '#a1a1aa',
                            500: '#71717a',
                            600: '#52525b',
                            800: '#27272a',
                            900: '#18181b',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@hotwired/turbo@8.0.4/dist/turbo.es2017-umd.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-rose-50/20 text-zinc-800 antialiased font-light flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-rose-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="text-2xl font-semibold tracking-widest text-zinc-800">
                        Rosel<span class="text-pink-500">ine</span>
                    </a>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="/" class="text-zinc-600 hover:text-pink-500 transition">Home</a>
                    <a href="{{ route('shop.index') }}" class="text-zinc-600 hover:text-pink-500 transition">Shop</a>
                    <div class="relative group">
                        <a href="{{ route('categories.index') }}" class="text-zinc-600 hover:text-pink-500 transition flex items-center gap-1">
                            Kategori
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </a>
                        <div class="absolute left-0 top-full pt-2 w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="bg-white rounded-xl shadow-lg border border-rose-100 py-2">
                                @php
                                    $navCategories = ['Parfum', 'Micellar Water', 'Skincare', 'Makeup', 'Haircare', 'Bodycare'];
                                @endphp
                                @foreach($navCategories as $cat)
                                    <a href="{{ route('shop.index', ['category' => $cat]) }}" class="block px-4 py-2 text-sm text-zinc-600 hover:bg-rose-50 hover:text-pink-500 transition-colors">{{ $cat }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search, Cart, Profile -->
                <div class="hidden md:flex items-center space-x-6">
                    <div class="relative">
                        <input type="text" placeholder="Cari produk..." class="w-48 pl-10 pr-4 py-2 rounded-full border border-rose-200 bg-rose-50 text-sm focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all placeholder-zinc-400">
                        <svg class="w-5 h-5 text-zinc-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <a href="{{ route('cart') }}" class="text-zinc-600 hover:text-pink-500 transition relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        @auth
                            @php $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count(); @endphp
                            @if($cartCount > 0)
                                <span class="absolute -top-2 -right-2 bg-pink-500 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center shadow-sm">{{ $cartCount }}</span>
                            @endif
                        @endauth
                    </a>
                    @auth
                        <div class="relative group">
                            <button class="flex items-center text-zinc-600 hover:text-pink-500 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </button>
                            <div class="absolute right-0 top-8 w-48 bg-white border border-rose-100 rounded-xl shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all flex flex-col">
                                <div class="px-4 py-2 border-b border-rose-50 mb-1">
                                    <p class="text-xs text-zinc-500 font-light truncate">Halo,</p>
                                    <p class="text-sm font-medium text-zinc-800 truncate">{{ Auth::user()->name }}</p>
                                </div>
                                <a href="{{ route('profile') }}" class="px-4 py-2 text-sm text-zinc-800 hover:bg-rose-50 hover:text-pink-500">Profil Saya</a>
                                <a href="/orders" class="px-4 py-2 text-sm text-zinc-800 hover:bg-rose-50 hover:text-pink-500">Pesanan Saya</a>
                                <form action="{{ route('logout') }}" method="POST" class="block w-full">
                                     @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-rose-50">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-pink-500 hover:text-pink-600 transition bg-rose-50 px-4 py-2 rounded-full border border-rose-100">
                            Masuk
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button class="text-zinc-600 hover:text-pink-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-rose-100 pt-16 pb-8 mt-12 text-zinc-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <a href="/" class="text-2xl font-semibold tracking-widest text-zinc-800 uppercase mb-4 block">
                    Aura<span class="text-pink-500">Glow</span>
                </a>
                <p class="text-sm font-light leading-relaxed">Menghadirkan kecantikan alami dengan sentuhan bahan premium. Temukan kilau sejatimu bersama kami.</p>
            </div>
            <div>
                <h4 class="font-medium text-zinc-800 mb-4">Navigasi</h4>
                <ul class="space-y-2 text-sm font-light">
                    <li><a href="/" class="hover:text-pink-500 transition">Halaman Utama</a></li>
                    <li><a href="/shop" class="hover:text-pink-500 transition">Belanja</a></li>
                    <li><a href="#" class="hover:text-pink-500 transition">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-pink-500 transition">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-medium text-zinc-800 mb-4">Layanan Pelanggan</h4>
                <ul class="space-y-2 text-sm font-light">
                    <li><a href="#" class="hover:text-pink-500 transition">F.A.Q</a></li>
                    <li><a href="#" class="hover:text-pink-500 transition">Pengiriman</a></li>
                    <li><a href="#" class="hover:text-pink-500 transition">Kebijakan Pengembalian</a></li>
                    <li><a href="#" class="hover:text-pink-500 transition">Cara Belanja</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-medium text-zinc-800 mb-4">Temukan Kami</h4>
                <div class="flex space-x-4 mb-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-rose-50 flex items-center justify-center text-pink-500 hover:bg-pink-500 hover:text-white transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-rose-50 flex items-center justify-center text-pink-500 hover:bg-pink-500 hover:text-white transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
                <p class="text-sm font-light">Dapatkan info eksklusif & promo!</p>
                <div class="mt-2 flex">
                    <input type="email" placeholder="Email Anda" class="w-full px-4 py-2 rounded-l-full border border-rose-200 bg-rose-50 text-sm focus:outline-none focus:border-pink-300">
                    <button class="bg-pink-500 text-white px-4 py-2 rounded-r-full text-sm font-medium hover:bg-pink-600 transition">Kirim</button>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-rose-100 text-center text-sm font-light">
            &copy; 2026 AuraGlow Cosmetics. Hak Cipta Dilindungi.
        </div>
    </footer>
</body>
</html>
