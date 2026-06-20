@extends('layouts.app')

@section('title', 'Katalog | AuraGlow')

@section('content')
<div class="bg-rose-50/10 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Katalog -->
        <div class="mb-10 block md:flex md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-serif italic text-zinc-800 mb-2">Polesan Sempurna</h1>
                <p class="text-zinc-500 font-light">Menampilkan 120 produk berkualitas</p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center gap-4">
                <span class="text-sm text-zinc-500">Urutkan berdasarkan:</span>
                <select class="border-rose-200 text-zinc-700 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block p-2.5 bg-white shadow-sm">
                    <option selected>Terbaru</option>
                    <option value="1">Harga: Rendah ke Tinggi</option>
                    <option value="2">Harga: Tinggi ke Rendah</option>
                    <option value="3">Terlaris</option>
                </select>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <form action="{{ route('shop.index') }}" method="GET" id="filter-form" class="w-full lg:w-1/4">
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-rose-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-medium text-zinc-800">Filter</h3>
                        <a href="{{ route('shop.index') }}" class="text-sm text-pink-500 hover:text-pink-600">Reset</a>
                    </div>

                    <div class="mb-8 border-b border-rose-100 pb-6">
                        <h4 class="text-sm font-medium text-zinc-800 mb-4 uppercase tracking-wider">Kategori</h4>
                        <div class="space-y-3">
                            @foreach($categories as $category)
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="categories[]" value="{{ $category->category }}" onchange="document.getElementById('filter-form').submit();"
                                    class="w-4 h-4 text-pink-500 bg-rose-50 border-rose-200 rounded focus:ring-pink-500 focus:ring-2 cursor-pointer"
                                    {{ in_array($category->category, $selectedCategories) ? 'checked' : '' }}>
                                <span class="ml-3 text-sm text-zinc-600 font-light hover:text-pink-500 transition">{{ $category->category }} <span class="text-zinc-400 text-xs ml-1">({{ $category->total }})</span></span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- <div class="mb-8 border-b border-rose-100 pb-6">
                        <h4 class="text-sm font-medium text-zinc-800 mb-4 uppercase tracking-wider">Harga</h4>
                        <div class="space-y-4">
                            <input type="range" min="0" max="1000" value="500" class="w-full h-1 bg-rose-200 rounded-lg appearance-none cursor-pointer accent-pink-500">
                            <div class="flex items-center justify-between gap-4">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-zinc-400 text-sm">Rp</span>
                                    <input type="text" value="0" class="w-full pl-8 pr-3 py-2 text-sm border border-rose-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-pink-500 text-zinc-600 bg-rose-50">
                                </div>
                                <span class="text-zinc-400">-</span>
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-zinc-400 text-sm">Rp</span>
                                    <input type="text" value="1.5M" class="w-full pl-8 pr-3 py-2 text-sm border border-rose-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-pink-500 text-zinc-600 bg-rose-50">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-zinc-800 mb-4 uppercase tracking-wider">Warna / Shade</h4>
                        <div class="flex flex-wrap gap-3">
                            <button class="w-8 h-8 rounded-full bg-[#f8d0c4] border-2 border-white ring-2 ring-transparent hover:ring-pink-300 focus:ring-pink-500 transition shadow-sm"></button>
                            <button class="w-8 h-8 rounded-full bg-[#e8a395] border-2 border-white ring-2 ring-transparent hover:ring-pink-300 focus:ring-pink-500 transition shadow-sm"></button>
                            <button class="w-8 h-8 rounded-full bg-[#c97464] border-2 border-white ring-2 ring-pink-500 transition shadow-sm"></button>
                            <button class="w-8 h-8 rounded-full bg-[#8c4033] border-2 border-white ring-2 ring-transparent hover:ring-pink-300 focus:ring-pink-500 transition shadow-sm"></button>
                            <button class="w-8 h-8 rounded-full bg-[#e3ae9f] border-2 border-white ring-2 ring-transparent hover:ring-pink-300 focus:ring-pink-500 transition shadow-sm"></button>
                            <button class="w-8 h-8 rounded-full bg-[#df8d80] border-2 border-white ring-2 ring-transparent hover:ring-pink-300 focus:ring-pink-500 transition shadow-sm"></button>
                            <button class="w-8 h-8 rounded-full bg-[#f1eeea] border-2 border-white ring-2 ring-transparent hover:ring-pink-300 focus:ring-pink-500 transition shadow-sm"></button>
                            <button class="w-8 h-8 rounded-full bg-[#cbaca2] border-2 border-white ring-2 ring-transparent hover:ring-pink-300 focus:ring-pink-500 transition shadow-sm"></button>
                        </div>
                    </div> -->
                </div>
            </form>

            <!-- Grid Produk (Kolom Kanan) -->
            <div class="w-full lg:w-3/4">
                <!-- Grid 4 Kolom di layar besar -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    
                    @forelse ($products as $product)
                    <!-- Kartu Produk -->
                    <div class="group cursor-pointer flex flex-col bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md border border-rose-50 transition duration-300">
                        <div class="relative bg-rose-50/50 h-64 flex items-center justify-center p-4 overflow-hidden">
                            @if(is_array($product->images) && count($product->images) > 0)
                                <img src="{{ Storage::url($product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-xl transition duration-700 group-hover:scale-110">
                            @else
                                <img src="https://images.unsplash.com/photo-1596462502278-27bf85033e5a?auto=format&fit=crop&w=400&q=80" alt="Produk" class="w-full h-full object-cover rounded-xl transition duration-700 group-hover:scale-110">
                            @endif
                            <button class="absolute top-4 right-4 bg-white/90 backdrop-blur rounded-full p-2 text-zinc-400 group-hover:text-pink-500 shadow-sm transition hover:scale-110">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </button>
                            
                            <!-- Overlay Tambah Keranjang -->
                            <div class="absolute inset-x-0 bottom-0 p-4 opacity-0 translate-y-full group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 bg-gradient-to-t from-black/50 to-transparent">
                                <a href="{{ route('cart.add', $product->id) }}" class="block text-center absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur text-zinc-800 py-3 rounded-xl font-medium shadow-lg opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 hover:bg-zinc-800 hover:text-white">
                                    Tambah ke Keranjang
                                </a>
                            </div>
                        </div>
                        <div class="p-4 flex flex-col flex-grow">
                            <div class="flex items-center gap-1 mb-1">
                                <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                <span class="text-[11px] text-zinc-500">({{ $product->rating ?? '0' }}/5)</span>
                            </div>
                            <h3 class="text-sm text-zinc-800 font-medium group-hover:text-pink-500 transition line-clamp-2 mb-1">
                                <a href="{{ route('shop.show', $product->id) }}">{{ $product->name }}</a>
                            </h3>
                            <p class="text-xs text-zinc-500 mb-3 font-light line-clamp-1">{{ $product->description }}</p>
                            <div class="mt-auto flex items-center justify-between">
                                <span class="text-sm font-semibold text-zinc-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="col-span-full py-12 text-center text-zinc-500">Belum ada produk.</p>
                    @endforelse

                </div>

                <!-- Pagination -->
                <div class="mt-12 flex items-center justify-center">
                    {{ $products->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
