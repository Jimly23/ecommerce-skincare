@extends('layouts.app')

@section('title', 'Pesanan Saya | AuraGlow')

@section('content')
<div class="bg-rose-50/10 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row gap-8">
        
        <!-- Sidebar Dashboard User -->
        <!-- <aside class="w-full md:w-64 shrink-0">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-rose-100 sticky top-28">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 rounded-full bg-pink-100 text-pink-500 flex items-center justify-center text-xl font-serif italic">
                        AG
                    </div>
                    <div>
                        <h2 class="text-[15px] font-medium text-zinc-800">Amanda Gabriella</h2>
                        <p class="text-xs text-zinc-500">Member Silver</p>
                    </div>
                </div>

                <nav class="space-y-1">
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-zinc-600 hover:bg-rose-50 hover:text-pink-500 transition">
                        <svg class="w-5 h-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Profil Saya
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-pink-600 bg-rose-50 transition relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Pesanan Saya
                        <span class="absolute right-4 bg-pink-500 text-white text-[10px] px-2 py-0.5 rounded-full font-bold">2</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-zinc-600 hover:bg-rose-50 hover:text-pink-500 transition">
                        <svg class="w-5 h-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        Wishlist
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-zinc-600 hover:bg-rose-50 hover:text-pink-500 transition">
                        <svg class="w-5 h-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Daftar Alamat
                    </a>
                </nav>
                
                <div class="mt-8 pt-6 border-t border-rose-100">
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm font-medium text-red-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Keluar
                    </a>
                </div>
            </div>
        </aside> -->

        <!-- Konten Utama: Daftar Pesanan -->
        <main class="flex-1">
            <div class="mb-8 border-b border-zinc-200">
                <nav class="-mb-px flex space-x-8 overflow-x-auto custom-scrollbar" aria-label="Tabs">
                    <a href="{{ route('orders', ['status' => 'all']) }}" class="{{ !isset($status) || $status == 'all' ? 'border-pink-500 text-pink-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">Semua Pesanan</a>
                    <!-- <a href="{{ route('orders', ['status' => 'pending']) }}" class="{{ (isset($status) && $status == 'pending') ? 'border-pink-500 text-pink-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">Menunggu Pembayaran</a> -->
                    <a href="{{ route('orders', ['status' => 'processing']) }}" class="{{ (isset($status) && $status == 'processing') ? 'border-pink-500 text-pink-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">Sedang Dikemas</a>
                    <a href="{{ route('orders', ['status' => 'shipping']) }}" class="{{ (isset($status) && $status == 'shipping') ? 'border-pink-500 text-pink-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">Dikirim</a>
                    <a href="{{ route('orders', ['status' => 'completed']) }}" class="{{ (isset($status) && $status == 'completed') ? 'border-pink-500 text-pink-600' : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">Selesai</a>
                </nav>
            </div>

            <!-- List Pesanan -->
            <div class="space-y-6">

                @forelse($orders as $order)
                <div class="bg-white rounded-3xl shadow-sm border border-rose-100 overflow-hidden {{ $order->status === 'completed' ? 'opacity-75 hover:opacity-100 transition' : '' }}">
                    <div class="bg-rose-50/50 px-6 py-4 border-b border-rose-100 flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-6">
                            <div>
                                <p class="text-xs text-zinc-500 mb-1">Nomor Order</p>
                                <p class="text-sm font-medium text-zinc-800">#{{ $order->invoice_number }}</p>
                            </div>
                            <div class="hidden sm:block w-px h-8 bg-rose-200"></div>
                            <div>
                                <p class="text-xs text-zinc-500 mb-1">Tanggal Transaksi</p>
                                <p class="text-sm font-medium text-zinc-800">{{ $order->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        
                        @if($order->status === 'pending')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 shadow-sm border border-gray-200">
                                Menunggu Pembayaran
                            </span>
                        @elseif($order->status === 'paid' || $order->status === 'processing')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 shadow-sm border border-blue-200">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                Sedang Dikemas
                            </span>
                        @elseif($order->status === 'shipping')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800 shadow-sm border border-purple-200">
                                Sedang Dikirim
                            </span>
                        @elseif($order->status === 'completed')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 shadow-sm border border-green-200">
                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Selesai
                            </span>
                        @elseif($order->status === 'cancelled')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 shadow-sm border border-red-200">
                                Dibatalkan
                            </span>
                        @endif
                    </div>
                    
                    <div class="p-6 flex flex-col md:flex-row gap-6">
                        <div class="flex-1 space-y-6 flex flex-col justify-center">
                            @foreach($order->items as $item)
                            <div class="flex gap-4">
                                <div class="w-20 h-20 rounded-xl overflow-hidden shrink-0 border border-rose-100 bg-rose-50 {{ $order->status === 'completed' ? 'grayscale hover:grayscale-0 transition' : '' }}">
                                    @if($item->product && is_array($item->product->images) && count($item->product->images) > 0)
                                        <img src="{{ Storage::url($item->product->images[0]) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1629198688000-71f23e745b6e?auto=format&fit=crop&w=150&q=80" alt="Produk" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-zinc-800 mb-1">{{ $item->product ? $item->product->name : 'Produk Tidak Diketahui' }}</h3>
                                    <p class="text-xs text-zinc-500 mb-2">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    <p class="text-sm font-semibold text-zinc-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                            
                            @if(in_array($order->status, ['paid', 'processing']))
                            <!-- Progres Pengiriman -->
                            <div class="bg-rose-50/50 p-4 rounded-xl border border-rose-100 mt-2">
                                <p class="text-xs font-medium text-zinc-800 mb-1">Status Resi:</p>
                                <p class="text-sm text-zinc-600 font-light truncate">Pesanan Anda sedang dalam proses pengemasan oleh Seller.</p>
                            </div>
                            @elseif($order->status === 'shipping')
                            <div class="bg-rose-50/50 p-4 rounded-xl border border-rose-100 mt-2">
                                <p class="text-xs font-medium text-zinc-800 mb-1">Status Resi:</p>
                                <p class="text-sm text-zinc-600 font-light truncate">Pesanan Anda sedang dalam perjalanan oleh kurir.</p>
                            </div>
                            @endif
                        </div>
                        
                        <div class="md:w-56 shrink-0 flex flex-col md:border-l border-t md:border-t-0 md:pl-6 pt-6 md:pt-0 border-rose-100 justify-center">
                            <p class="text-xs text-zinc-500 mb-1">Total Belanja ({{ $order->items->sum('quantity') }} Barang)</p>
                            <p class="text-lg font-bold text-zinc-800 mb-4">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            <div class="mt-auto space-y-2 w-full">
                                @if($order->status == 'pending')
                                    <a href="{{ route('payment.waiting', $order->id) }}" class="block text-center w-full bg-pink-500 text-white rounded-xl py-2.5 text-sm font-medium hover:bg-pink-600 transition shadow-sm">Bayar Sekarang</a>
                                @elseif(in_array($order->status, ['paid', 'processing', 'shipping']))
                                    <form id="complete-form-{{ $order->id }}" action="{{ route('orders.complete', $order->id) }}" method="POST" class="w-full">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" onclick="openConfirmModal(event, 'complete-form-{{ $order->id }}')" class="w-full bg-pink-500 text-white rounded-xl py-2.5 text-sm font-medium hover:bg-pink-600 transition shadow-sm">Pesanan Diterima</button>
                                    </form>
                                @else
                                    <button class="w-full bg-white text-zinc-800 border border-zinc-300 rounded-xl py-2.5 text-sm font-medium hover:border-pink-500 hover:text-pink-500 transition shadow-sm">Beli Lagi</button>
                                @endif
                                <button class="w-full bg-white text-zinc-600 border border-zinc-200 rounded-xl py-2.5 text-sm font-medium hover:text-pink-500 hover:border-pink-300 transition">Hubungi Penjual</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="text-center py-16 bg-white rounded-3xl shadow-sm border border-rose-100">
                        <div class="w-24 h-24 bg-rose-50 rounded-full flex items-center justify-center mx-auto mb-4 text-pink-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-zinc-800 mb-2">Belum ada pesanan</h3>
                        <p class="text-zinc-500 mb-6 font-light">Mulai belanja dan temukan produk terbaik untuk Anda.</p>
                        <a href="/shop" class="inline-block bg-zinc-800 text-white px-8 py-3 rounded-full hover:bg-pink-500 transition shadow-lg">Lihat Produk</a>
                    </div>
                @endforelse

            </div>

        </main>
    </div>
</div>

<!-- Modal Konfirmasi Pesanan Diterima -->
<div id="confirm-modal" class="fixed inset-0 z-50 hidden bg-black/50 items-center justify-center p-4 transition-opacity duration-300">
    <div class="bg-white rounded-3xl p-8 max-w-sm w-full mx-auto text-center border border-rose-100 shadow-xl flex flex-col items-center transform scale-95 transition-transform duration-300" id="confirm-modal-content">
        <div class="w-16 h-16 bg-green-100 text-green-500 rounded-full flex items-center justify-center mb-6 shadow-inner">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <h3 class="text-xl font-medium text-zinc-800 mb-2">Terima Pesanan?</h3>
        <p class="text-sm text-zinc-500 mb-8 font-light">Apakah Anda yakin telah menerima pesanan ini dengan baik? Aksi ini tidak dapat dibatalkan.</p>
        <div class="flex gap-4 w-full">
            <button type="button" onclick="closeConfirmModal()" class="flex-1 bg-white border border-rose-200 text-zinc-600 py-3 rounded-full text-sm font-medium hover:bg-rose-50 transition">Batal</button>
            <button type="button" onclick="submitConfirmForm()" class="flex-1 bg-pink-500 text-white py-3 rounded-full text-sm font-medium hover:bg-pink-600 shadow-lg shadow-pink-500/30 transition">Ya, Terima</button>
        </div>
    </div>
</div>

<script>
    let formToSubmit = null;

    function openConfirmModal(event, formId) {
        event.preventDefault();
        formToSubmit = document.getElementById(formId);
        let modal = document.getElementById('confirm-modal');
        let content = document.getElementById('confirm-modal-content');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        setTimeout(() => {
            content.classList.remove('scale-95');
            content.classList.add('scale-100');
        }, 10);
    }

    function closeConfirmModal() {
        let modal = document.getElementById('confirm-modal');
        let content = document.getElementById('confirm-modal-content');
        
        content.classList.remove('scale-100');
        content.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            formToSubmit = null;
        }, 300);
    }

    function submitConfirmForm() {
        if (formToSubmit) {
            formToSubmit.submit();
        }
    }
</script>
@endsection
