@extends('layouts.app')

@section('title', 'AuraGlow | Kosmetik Mewah')

@section('content')
<!-- Hero Carousel Section -->
<section class="relative bg-gradient-to-b from-rose-50 to-white pt-6 pb-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Carousel Container -->
        <div class="relative overflow-hidden rounded-3xl group" id="hero-carousel">
            <!-- Slides Track -->
            <div class="flex transition-transform duration-500 ease-out" id="carousel-track">
                <!-- Slide 1: Flash Sale -->
                <div class="w-full flex-shrink-0">
                    <div class="relative h-[200px] sm:h-[280px] md:h-[360px] lg:h-[400px] rounded-3xl overflow-hidden bg-gradient-to-r from-pink-500 via-pink-400 to-rose-300">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full flex items-center justify-between px-8 md:px-16">
                                <div class="z-10">
                                    <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4">Flash Sale</span>
                                    <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white leading-tight">Disc. up to <span class="text-yellow-300">50%</span></h2>
                                    <p class="text-white/80 text-sm md:text-base mt-3 font-light">Koleksi skincare premium pilihan terbaik</p>
                                    <a href="/shop" class="inline-flex items-center gap-2 mt-5 bg-white text-pink-500 px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-yellow-300 hover:text-pink-600 transition-all shadow-lg">
                                        Belanja Sekarang
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                </div>
                                <div class="hidden md:block relative">
                                    <img src="{{ asset('images/poster1.jpeg') }}" alt="Flash Sale" class="h-[260px] lg:h-[340px] object-cover rounded-2xl shadow-2xl border-4 border-white/30 rotate-3 hover:rotate-0 transition-transform duration-500">
                                    <div class="absolute -top-3 -right-3 bg-yellow-400 text-pink-600 text-xs font-extrabold px-3 py-1.5 rounded-full shadow-lg animate-pulse">-50%</div>
                                </div>
                            </div>
                        </div>
                        <!-- Decorative circles -->
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
                        <div class="absolute -bottom-12 -left-12 w-56 h-56 bg-white/5 rounded-full"></div>
                    </div>
                </div>

                <!-- Slide 2: New Arrival -->
                <div class="w-full flex-shrink-0">
                    <div class="relative h-[200px] sm:h-[280px] md:h-[360px] lg:h-[400px] rounded-3xl overflow-hidden bg-gradient-to-r from-violet-500 via-purple-400 to-fuchsia-400">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full flex items-center justify-between px-8 md:px-16">
                                <div class="z-10">
                                    <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4">New Arrival</span>
                                    <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white leading-tight">Koleksi <span class="text-yellow-300">Terbaru</span></h2>
                                    <p class="text-white/80 text-sm md:text-base mt-3 font-light">Parfum & skincare eksklusif musim ini</p>
                                    <a href="/shop" class="inline-flex items-center gap-2 mt-5 bg-white text-purple-500 px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-yellow-300 hover:text-purple-600 transition-all shadow-lg">
                                        Lihat Koleksi
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                </div>
                                <div class="hidden md:block relative">
                                    <img src="{{ asset('images/poster2.jpg') }}" alt="New Arrival" class="h-[260px] lg:h-[340px] object-cover rounded-2xl shadow-2xl border-4 border-white/30 -rotate-3 hover:rotate-0 transition-transform duration-500">
                                    <div class="absolute -top-3 -left-3 bg-yellow-400 text-purple-600 text-xs font-extrabold px-3 py-1.5 rounded-full shadow-lg">NEW</div>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -top-10 -left-10 w-44 h-44 bg-white/10 rounded-full"></div>
                        <div class="absolute -bottom-8 -right-8 w-48 h-48 bg-white/5 rounded-full"></div>
                    </div>
                </div>

                <!-- Slide 3: Free Ongkir -->
                <div class="w-full flex-shrink-0">
                    <div class="relative h-[200px] sm:h-[280px] md:h-[360px] lg:h-[400px] rounded-3xl overflow-hidden bg-gradient-to-r from-amber-500 via-orange-400 to-yellow-400">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full flex items-center justify-between px-8 md:px-16">
                                <div class="z-10">
                                    <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4">Promo Spesial</span>
                                    <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white leading-tight">Gratis <span class="text-zinc-800">Ongkir</span></h2>
                                    <p class="text-white/80 text-sm md:text-base mt-3 font-light">Se-Indonesia tanpa minimum belanja</p>
                                    <a href="/shop" class="inline-flex items-center gap-2 mt-5 bg-white text-amber-600 px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-zinc-800 hover:text-white transition-all shadow-lg">
                                        Klaim Sekarang
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                </div>
                                <div class="hidden md:block relative">
                                    <img src="{{ asset('images/poster3.jpg') }}" alt="Free Ongkir" class="h-[260px] lg:h-[340px] object-cover rounded-2xl shadow-2xl border-4 border-white/30 rotate-2 hover:rotate-0 transition-transform duration-500">
                                    <div class="absolute -bottom-3 -right-3 bg-zinc-800 text-yellow-400 text-xs font-extrabold px-3 py-1.5 rounded-full shadow-lg">FREE</div>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -top-12 -right-12 w-52 h-52 bg-white/10 rounded-full"></div>
                        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/5 rounded-full"></div>
                    </div>
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button onclick="carouselPrev()" class="absolute left-3 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center text-zinc-600 hover:bg-white hover:text-pink-500 transition shadow-lg opacity-0 group-hover:opacity-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button onclick="carouselNext()" class="absolute right-3 top-1/2 -translate-y-1/2 z-20 w-10 h-10 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center text-zinc-600 hover:bg-white hover:text-pink-500 transition shadow-lg opacity-0 group-hover:opacity-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>

            <!-- Dots Indicator -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-20 flex gap-2" id="carousel-dots">
                <button onclick="goToSlide(0)" class="w-8 h-2 rounded-full bg-white transition-all duration-300 shadow-sm"></button>
                <button onclick="goToSlide(1)" class="w-2 h-2 rounded-full bg-white/50 transition-all duration-300 shadow-sm"></button>
                <button onclick="goToSlide(2)" class="w-2 h-2 rounded-full bg-white/50 transition-all duration-300 shadow-sm"></button>
            </div>
        </div>

        <!-- Trust Badges -->
        <div class="flex flex-wrap justify-center gap-6 md:gap-10 mt-5 py-3">
            <div class="flex items-center gap-2 text-zinc-600">
                <div class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center text-pink-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <span class="text-sm font-medium">100% Original</span>
            </div>
            <div class="flex items-center gap-2 text-zinc-600">
                <div class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center text-pink-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </div>
                <span class="text-sm font-medium">Garansi Retur</span>
            </div>
            <div class="flex items-center gap-2 text-zinc-600">
                <div class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center text-pink-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-sm font-medium">Pengiriman Cepat</span>
            </div>
            <div class="flex items-center gap-2 text-zinc-600">
                <div class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center text-pink-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <span class="text-sm font-medium">Pembayaran Aman</span>
            </div>
        </div>
    </div>
</section>

<script>
    (function() {
        let currentSlide = 0;
        const totalSlides = 3;
        const track = document.getElementById('carousel-track');
        const dots = document.getElementById('carousel-dots').children;
        let autoPlayInterval;

        function updateCarousel() {
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
            for (let i = 0; i < dots.length; i++) {
                dots[i].className = i === currentSlide 
                    ? 'w-8 h-2 rounded-full bg-white transition-all duration-300 shadow-sm' 
                    : 'w-2 h-2 rounded-full bg-white/50 transition-all duration-300 shadow-sm';
            }
        }

        window.carouselNext = function() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateCarousel();
            resetAutoPlay();
        };

        window.carouselPrev = function() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateCarousel();
            resetAutoPlay();
        };

        window.goToSlide = function(index) {
            currentSlide = index;
            updateCarousel();
            resetAutoPlay();
        };

        function resetAutoPlay() {
            clearInterval(autoPlayInterval);
            autoPlayInterval = setInterval(() => { window.carouselNext(); }, 5000);
        }

        // Touch/swipe support
        let startX = 0, endX = 0;
        const carousel = document.getElementById('hero-carousel');
        carousel.addEventListener('touchstart', e => { startX = e.touches[0].clientX; }, { passive: true });
        carousel.addEventListener('touchend', e => {
            endX = e.changedTouches[0].clientX;
            if (startX - endX > 50) window.carouselNext();
            else if (endX - startX > 50) window.carouselPrev();
        });

        resetAutoPlay();
    })();
</script>

<!-- Produk Terlaris Grid -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-normal text-zinc-800 mb-4">Produk <span class="font-serif italic text-pink-500">Terlaris</span></h2>
            <p class="text-zinc-500 font-light max-w-2xl mx-auto">Pilihan favorit pelanggan untuk mewujudkan kilau alami dan nutrisi kulit yang sempurna setiap hari.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12">
            
            @foreach($bestsellers as $product)
            <!-- Produk Card -->
            <div class="group cursor-pointer flex flex-col">
                <div class="relative bg-rose-50/50 rounded-3xl overflow-hidden mb-4 h-80 flex items-center justify-center p-4">
                    @if(is_array($product->images) && count($product->images) > 0)
                        <img src="{{ Storage::url($product->images[0]) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-2xl shadow-sm transition duration-700 group-hover:scale-105">
                    @else
                        <img src="https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=600&q=80" alt="Produk" class="w-full h-full object-cover rounded-2xl shadow-sm transition duration-700 group-hover:scale-105">
                    @endif
                    <!-- Badge Diskon / Baru -->
                    @if($loop->first)
                    <div class="absolute top-6 left-6 bg-pink-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg">
                        Terlaris
                    </div>
                    @endif
                    <!-- Icon Wishlist -->
                    <button class="absolute top-6 right-6 bg-white/90 backdrop-blur rounded-full p-2.5 text-zinc-400 group-hover:text-pink-500 shadow-sm transition hover:scale-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>
                    <a href="{{ route('cart.add', $product->id) }}" class="block text-center absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur text-zinc-800 py-3 rounded-xl font-medium shadow-lg opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 hover:bg-zinc-800 hover:text-white">
                        Tambah ke Keranjang
                    </a>
                </div>
                <!-- Info Produk -->
                <div class="flex flex-col flex-grow">
                    <div class="flex flex-col mb-1">
                         <div class="flex items-center gap-1 mb-1">
                            <div class="flex text-yellow-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </div>
                            <span class="text-xs text-zinc-500">({{ $product->rating ?? '0' }}/5)</span>
                        </div>
                        <h3 class="text-lg text-zinc-800 font-medium group-hover:text-pink-500 transition line-clamp-1"><a href="{{ route('shop.show', $product->id) }}">{{ $product->name }}</a></h3>
                        <p class="text-sm text-zinc-500 mb-2 font-light">Kecantikan</p>
                    </div>
                    <div class="mt-auto flex items-center gap-2">
                        <span class="text-lg font-semibold text-zinc-800">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        
        <div class="mt-16 text-center">
            <a href="/shop" class="inline-flex items-center gap-2 border-b-2 border-pink-500 text-zinc-800 font-medium uppercase tracking-wider text-sm pb-1 hover:text-pink-500 transition">
                Lihat Semua Produk
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</section>
@endsection
