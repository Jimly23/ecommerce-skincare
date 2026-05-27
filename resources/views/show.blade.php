@extends('layouts.app')

@section('title', 'Luminous Silk Foundation | AuraGlow')

@section('content')
<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-zinc-500 font-light mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li class="inline-flex items-center">
                    <a href="/" class="hover:text-pink-500 transition">Home</a>
                </li>
                <li><span class="mx-2">/</span></li>
                <li>
                    <a href="/shop" class="hover:text-pink-500 transition">Makeup</a>
                </li>
                <li><span class="mx-2">/</span></li>
                <li class="text-zinc-800" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-12 xl:gap-16">
            <!-- Galeri Foto (Kolom Kiri) -->
            <div class="w-full lg:w-1/2 flex flex-col-reverse sm:flex-row gap-4">
                <!-- Thumbnail -->
                <div class="flex sm:flex-col gap-4 overflow-x-auto sm:overflow-visible">
                    @if(is_array($product->images))
                        @foreach($product->images as $index => $img)
                        <button type="button" onclick="changeImage('{{ Storage::url($img) }}', this)" class="thumbnail-btn w-20 h-24 sm:w-24 sm:h-28 shrink-0 rounded-xl overflow-hidden border {{ $index === 0 ? 'border-2 border-pink-500' : 'border-rose-100 hover:border-pink-300' }} transition">
                            <img src="{{ Storage::url($img) }}" alt="Thumbnail {{ $index + 1 }}" class="w-full h-full object-cover {{ $index === 0 ? '' : 'opacity-70 hover:opacity-100 transition' }}">
                        </button>
                        @endforeach
                    @endif
                </div>
                
                <!-- Gambar Utama -->
                <div class="w-full h-[400px] sm:h-[500px] lg:h-[600px] rounded-3xl overflow-hidden relative shadow-sm border border-rose-50 flex-grow">
                    @if(is_array($product->images) && count($product->images) > 0)
                        <img id="main-product-image" src="{{ Storage::url($product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-opacity duration-300">
                    @else
                        <img id="main-product-image" src="https://images.unsplash.com/photo-1629198688000-71f23e745b6e?auto=format&fit=crop&w=800&q=80" alt="Luminous Silk Foundation" class="w-full h-full object-cover transition-opacity duration-300">
                    @endif
                    <!-- Wishlist absolute on main image -->
                    <button class="absolute top-6 right-6 bg-white/90 backdrop-blur rounded-full p-3 text-zinc-400 hover:text-pink-500 shadow-md transition hover:scale-110">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Detail Produk (Kolom Kanan) -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center">
                <span class="text-pink-500 font-medium text-sm tracking-widest uppercase mb-2 block">Produk</span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-serif italic text-zinc-900 mb-4">{{ $product->name }}</h1>
                
                <div class="flex items-center gap-4 mb-6 relative">
                     <div class="flex text-yellow-400">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <span class="ml-2 text-zinc-600">({{ $product->rating ?? '0' }}/5)</span>
                    </div>
                </div>

                <div class="text-3xl font-light text-zinc-900 mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</div>

                <p class="text-zinc-600 font-light leading-relaxed mb-8">
                    {{ $product->description }}
                </p>

                <!-- Aksi: Kuantitas & ATC -->
                <div class="sm:flex sm:flex-row gap-4 mb-4 pt-6 border-t border-rose-100">
                    <!-- Tombol Tambah ke Keranjang -->
                    <a href="{{ route('cart.add', $product->id) }}" class="flex-1 bg-rose-50 text-pink-600 h-14 rounded-full font-medium hover:bg-pink-50 transition border border-rose-100 flex items-center justify-center gap-2 mb-2 sm:mb-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Tambahkan ke Keranjang
                    </a>
                    
                    <a href="{{ route('checkout', ['product_id' => $product->id]) }}" class="flex-1 bg-zinc-800 text-white h-14 rounded-full font-medium hover:bg-pink-500 hover:shadow-xl hover:shadow-pink-200 transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Beli Langsung
                    </a>
                </div>
                
                <a href="{{ route('chat.index', ['product' => $product->name]) }}" class="w-full bg-white text-zinc-600 h-14 mb-10 rounded-full font-medium hover:text-pink-500 hover:border-pink-300 transition border border-zinc-200 flex items-center justify-center gap-2 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    Hubungi Penjual
                </a>

                <!-- Accordion Deskripsi/Bahan -->
                <div class="border-t border-rose-100 divide-y divide-rose-100">
                    <details class="group py-4" open>
                        <summary class="flex justify-between items-center font-medium cursor-pointer list-none text-zinc-800">
                            Deskripsi Produk
                            <span class="transition group-open:rotate-180">
                                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        <p class="text-zinc-600 font-light text-sm mt-3 leading-relaxed">
                            {{ $product->description }}
                        </p>
                    </details>
                    <details class="group py-4">
                        <summary class="flex justify-between items-center font-medium cursor-pointer list-none text-zinc-800">
                            Bahan (Ingredients) Utama
                            <span class="transition group-open:rotate-180">
                                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        <p class="text-zinc-600 font-light text-sm mt-3 leading-relaxed">
                            {{ $product->main_ingredients ?: 'Informasi bahan tidak tersedia.' }}
                        </p>
                    </details>
                    <details class="group py-4">
                        <summary class="flex justify-between items-center font-medium cursor-pointer list-none text-zinc-800">
                            Cara Penggunaan
                            <span class="transition group-open:rotate-180">
                                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        <p class="text-zinc-600 font-light text-sm mt-3 leading-relaxed">
                            {{ $product->how_to_use ?: 'Petunjuk penggunaan tidak tersedia.' }}
                        </p>
                    </details>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function changeImage(imgUrl, element) {
        let mainImg = document.getElementById('main-product-image');
        mainImg.style.opacity = '0.5';
        setTimeout(() => {
            mainImg.src = imgUrl;
            mainImg.style.opacity = '1';
        }, 150);

        let buttons = document.querySelectorAll('.thumbnail-btn');
        buttons.forEach(btn => {
            btn.classList.remove('border-2', 'border-pink-500');
            btn.classList.add('border-rose-100', 'hover:border-pink-300');
            let img = btn.querySelector('img');
            img.classList.add('opacity-70', 'hover:opacity-100');
        });
        
        element.classList.remove('border-rose-100', 'hover:border-pink-300');
        element.classList.add('border-2', 'border-pink-500');
        let activeImg = element.querySelector('img');
        activeImg.classList.remove('opacity-70', 'hover:opacity-100');
    }
</script>
@endsection
