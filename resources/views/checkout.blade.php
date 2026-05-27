@extends('layouts.app')

@section('title', 'Checkout | AuraGlow')

@section('content')
<div class="bg-rose-50/10 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="text-3xl font-serif italic text-zinc-900 mb-8">Checkout</h1>

        <div class="flex flex-col-reverse lg:flex-row gap-12">
            <!-- Form Checkout (Kolom Kiri) -->
            <div class="w-full lg:w-3/5 xl:w-2/3">
                <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    
                    <!-- Informasi Kontak -->
                    <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-rose-100 mb-8 mt-0">
                        <h2 class="text-xl font-medium text-zinc-800 mb-6 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-rose-100 text-pink-500 flex items-center justify-center text-sm font-bold">1</span>
                            Informasi Kontak
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                            <div class="sm:col-span-2 pb-4 border-b border-rose-50 flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-zinc-500 mb-1">Alamat Email</p>
                                    <p class="text-base font-semibold text-zinc-800">{{ auth()->user()->email ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="pb-4 border-b sm:border-b-0 border-rose-50">
                                <p class="text-sm font-medium text-zinc-500 mb-1">Nama Lengkap Penerima</p>
                                <p class="text-base font-semibold text-zinc-800">{{ auth()->user()->recipient_name ?? auth()->user()->name ?? '-' }}</p>
                            </div>
                            <div class="pb-4">
                                <p class="text-sm font-medium text-zinc-500 mb-1">Nomor Telepon</p>
                                <p class="text-base font-semibold text-zinc-800">{{ auth()->user()->recipient_phone ?? auth()->user()->phone ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat Pengiriman -->
                    <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-rose-100 mb-8 mt-0">
                        <h2 class="text-xl font-medium text-zinc-800 mb-6 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-rose-100 text-pink-500 flex items-center justify-center text-sm font-bold">2</span>
                            Alamat Pengiriman
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                            <div class="sm:col-span-2 pb-4 border-b border-rose-50">
                                <p class="text-sm font-medium text-zinc-500 mb-2">Alamat Lengkap</p>
                                <p class="text-base text-zinc-800 leading-relaxed">{{ auth()->user()->address ?? '-' }}</p>
                            </div>
                            <div class="pb-4 border-b sm:border-b-0 border-rose-50">
                                <p class="text-sm font-medium text-zinc-500 mb-1">Kota / Kabupaten</p>
                                <p class="text-base font-semibold text-zinc-800">{{ auth()->user()->city ?? '-' }}</p>
                            </div>
                            <div class="pb-4 border-b sm:border-b-0 border-rose-50">
                                <p class="text-sm font-medium text-zinc-500 mb-1">Provinsi</p>
                                <p class="text-base font-semibold text-zinc-800">{{ auth()->user()->province ?? '-' }}</p>
                            </div>
                            <div class="pb-4 sm:col-span-2">
                                <p class="text-sm font-medium text-zinc-500 mb-1">Kode Pos</p>
                                <p class="text-base font-semibold text-zinc-800">{{ auth()->user()->postal_code ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-rose-100 text-right">
                            <a href="{{ route('profile') }}" class="text-sm font-medium text-pink-500 hover:text-pink-600 transition">Ubah Alamat di Profil</a>
                        </div>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-rose-100 mb-8 mt-0">
                        <h2 class="text-xl font-medium text-zinc-800 mb-6 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-rose-100 text-pink-500 flex items-center justify-center text-sm font-bold">3</span>
                            Metode Pembayaran
                        </h2>
                        
                        <div class="space-y-4">
                            <!-- Transfer Bank -->
                            <label class="relative flex cursor-pointer rounded-2xl border border-rose-200 bg-white p-4 items-center focus-within:ring-2 focus-within:ring-pink-500 hover:bg-rose-50 transition">
                                <input type="radio" name="payment_method" value="bank_transfer" class="sr-only peer" checked>
                                <div class="w-5 h-5 rounded-full border-2 border-zinc-300 peer-checked:border-pink-500 peer-checked:border-[6px] mr-4 transition-all"></div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <p class="font-medium text-zinc-800 text-sm">Transfer Bank (Virtual Account)</p>
                                        <div class="flex gap-2">
                                            <span class="bg-zinc-100 text-[10px] font-bold px-2 py-1 rounded text-zinc-600">BCA</span>
                                            <span class="bg-zinc-100 text-[10px] font-bold px-2 py-1 rounded text-zinc-600">MANDIRI</span>
                                        </div>
                                    </div>
                                    <p class="text-xs text-zinc-500 font-light mt-1">Verifikasi otomatis dalam hitungan menit.</p>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-pink-500 rounded-2xl pointer-events-none"></div>
                            </label>

                            <!-- E-Wallet -->
                            <label class="relative flex cursor-pointer rounded-2xl border border-rose-200 bg-white p-4 items-center focus-within:ring-2 focus-within:ring-pink-500 hover:bg-rose-50 transition">
                                <input type="radio" name="payment_method" value="ewallet" class="sr-only peer">
                                <div class="w-5 h-5 rounded-full border-2 border-zinc-300 peer-checked:border-pink-500 peer-checked:border-[6px] mr-4 transition-all"></div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <p class="font-medium text-zinc-800 text-sm">E-Wallet</p>
                                        <div class="flex gap-2">
                                            <span class="bg-zinc-100 text-[10px] font-bold px-2 py-1 rounded text-zinc-600 text-[#00AA13]">GoPay</span>
                                            <span class="bg-zinc-100 text-[10px] font-bold px-2 py-1 rounded text-zinc-600 text-[#4E106D]">OVO</span>
                                        </div>
                                    </div>
                                    <p class="text-xs text-zinc-500 font-light mt-1">Gunakan poin dan dapatkan cashback dari aplikasi.</p>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-pink-500 rounded-2xl pointer-events-none"></div>
                            </label>
                            
                            <!-- Kartu Kredit -->
                            <label class="relative flex cursor-pointer rounded-2xl border border-rose-200 bg-white p-4 items-center focus-within:ring-2 focus-within:ring-pink-500 hover:bg-rose-50 transition">
                                <input type="radio" name="payment_method" value="credit_card" class="sr-only peer">
                                <div class="w-5 h-5 rounded-full border-2 border-zinc-300 peer-checked:border-pink-500 peer-checked:border-[6px] mr-4 transition-all"></div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <p class="font-medium text-zinc-800 text-sm">Kartu Kredit / Debit</p>
                                        <div class="flex gap-1">
                                            <svg class="w-6 h-4" viewBox="0 0 24 16" fill="none"><rect width="24" height="16" rx="2" fill="#1434CB"/><circle cx="8" cy="8" r="4" fill="#EA001B"/><circle cx="16" cy="8" r="4" fill="#FFA200"/><path fill-rule="evenodd" clip-rule="evenodd" d="M12 11.23a4.015 4.015 0 0 0 0-6.46 4.015 4.015 0 0 0 0 6.46z" fill="#FF5F00"/></svg>
                                            <svg class="w-6 h-4" viewBox="0 0 24 16" fill="none"><rect width="24" height="16" rx="2" fill="#fff" stroke="#e5e5e5"/><path d="M11 2L8 14H5L8 2H11ZM18 2L15 14H12L15 2H18ZM21 2H23L20 14H18L21 2Z" fill="#1A1F71"/></svg>
                                        </div>
                                    </div>
                                    <p class="text-xs text-zinc-500 font-light mt-1">Pembayaran aman dengan 3D Secure.</p>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-pink-500 rounded-2xl pointer-events-none"></div>
                            </label>

                            <!-- QRIS -->
                            <label class="relative flex cursor-pointer rounded-2xl border border-rose-200 bg-white p-4 items-center focus-within:ring-2 focus-within:ring-pink-500 hover:bg-rose-50 transition">
                                <input type="radio" name="payment_method" value="qris" class="sr-only peer">
                                <div class="w-5 h-5 rounded-full border-2 border-zinc-300 peer-checked:border-pink-500 peer-checked:border-[6px] mr-4 transition-all"></div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <p class="font-medium text-zinc-800 text-sm">QRIS</p>
                                        <div class="flex gap-2">
                                            <span class="bg-zinc-100 text-[10px] font-bold px-2 py-1 rounded text-[#E71822]">QRIS</span>
                                        </div>
                                    </div>
                                    <p class="text-xs text-zinc-500 font-light mt-1">Scan kode bayar dengan aplikasi apa saja.</p>
                                </div>
                                <div class="absolute inset-0 border-2 border-transparent peer-checked:border-pink-500 rounded-2xl pointer-events-none"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Tombol Submit (Mobile Only) -->
                    <div class="lg:hidden mb-8">
                        <button type="button" onclick="handlePaymentSubmit()" class="w-full bg-zinc-800 text-white h-14 rounded-full font-medium hover:bg-pink-500 hover:shadow-xl hover:shadow-pink-200 transition-all duration-300 text-lg">
                            Bayar Sekarang
                        </button>
                    </div>

                </form>
            </div>

            <!-- Ringkasan Belanja (Kolom Kanan) -->
            <div class="w-full lg:w-2/5 xl:w-1/3 mt-0">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-rose-100 sticky top-28">
                    <h2 class="text-lg font-medium text-zinc-800 mb-6">Ringkasan Pesanan</h2>
                    
                    <!-- Item List -->
                    <div class="space-y-4 mb-6 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                        
                        @php $totalPrice = 0; @endphp
                        @forelse($items as $item)
                        @php 
                            $prod = $item->product; 
                            $totalPrice += ($prod->price * $item->quantity);
                        @endphp
                        <!-- Dynamic Item -->
                        <div class="flex gap-4">
                            <div class="w-20 h-20 rounded-xl overflow-hidden shrink-0 bg-rose-50 relative border border-rose-100 group">
                                @if(is_array($prod->images) && count($prod->images) > 0)
                                    <img src="{{ Storage::url($prod->images[0]) }}" alt="{{ $prod->name }}" class="w-full h-full object-cover">
                                @else
                                    <img src="https://images.unsplash.com/photo-1629198688000-71f23e745b6e?auto=format&fit=crop&w=150&q=80" alt="Produk" class="w-full h-full object-cover">
                                @endif
                                <span id="label_qty_{{ $item->id }}" class="absolute -top-2 -right-2 bg-zinc-800 text-white w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-bold">{{ $item->quantity }}</span>
                                
                                @if($item->id !== 'temp')
                                <a href="{{ route('cart.remove', $item->id) }}" class="absolute inset-0 bg-red-500/80 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </a>
                                @endif
                            </div>
                            <div class="flex-1 flex flex-col justify-center">
                                <h3 class="text-sm font-medium text-zinc-800 line-clamp-1 mb-1">{{ $prod->name }}</h3>
                                <div class="flex items-center gap-3 mb-2">
                                    <button type="button" onclick="updateQuantity('{{ $item->id }}', -1, {{ $prod->stock }}, {{ $prod->price }})" class="w-6 h-6 rounded-full bg-rose-100 text-pink-500 flex items-center justify-center hover:bg-pink-500 hover:text-white transition pb-0.5">-</button>
                                    <span class="text-xs font-semibold w-4 text-center">{{ $item->quantity }}</span>
                                    <input type="hidden" name="items[{{ $item->id }}][quantity]" id="qty_{{ $item->id }}" value="{{ $item->quantity }}" data-price="{{ $prod->price }}">
                                    <button type="button" onclick="updateQuantity('{{ $item->id }}', 1, {{ $prod->stock }}, {{ $prod->price }})" class="w-6 h-6 rounded-full bg-rose-100 text-pink-500 flex items-center justify-center hover:bg-pink-500 hover:text-white transition pb-0.5">+</button>
                                </div>
                                <p class="text-sm font-semibold text-zinc-800">Rp {{ number_format($prod->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @empty
                        <!-- Stub Item -->
                        <div class="flex gap-4 border-dashed border-2 border-zinc-200 p-4 rounded-xl items-center justify-center">
                            <span class="text-zinc-500 text-sm">Keranjang belanja Anda kosong</span>
                        </div>
                        @endforelse
                    </div>

                    <!-- Kode Promo -->
                    <div class="border-t border-b border-rose-50 py-4 mb-4">
                        <div class="flex gap-2">
                            <input type="text" placeholder="Kode Diskon" class="flex-1 px-4 py-2 text-sm border border-rose-200 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent bg-rose-50/30">
                            <button class="bg-zinc-200 text-zinc-600 px-4 py-2 rounded-xl text-sm font-medium hover:bg-zinc-300 transition">Terapkan</button>
                        </div>
                    </div>

                    <!-- Total Perhitungan -->
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm text-zinc-600 font-light">
                            <span>Subtotal</span>
                            <span id="display_subtotal">Rp {{ number_format($totalPrice ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-zinc-600 font-light">
                            <span>Pengiriman</span>
                            <span>Kalkulasi di tahap selanjutnya</span>
                        </div>
                        <div class="flex justify-between text-sm text-pink-500 font-medium">
                            <span>Diskon</span>
                            <span>- Rp 0</span>
                        </div>
                    </div>

                    <div class="border-t border-rose-200 pt-4 mb-6">
                        <div class="flex justify-between items-end">
                            <span class="text-base font-medium text-zinc-800">Total Tagihan</span>
                            <span id="display_total" class="text-2xl font-bold text-zinc-800">Rp {{ number_format($totalPrice ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <p class="text-[10px] text-zinc-400 mt-1 text-right">Termasuk PPN 11%</p>
                    </div>

                    <!-- Tombol Submit (Desktop Only) -->
                    <button type="button" onclick="handlePaymentSubmit()" class="hidden lg:flex w-full bg-zinc-800 text-white h-14 rounded-full font-medium hover:bg-pink-500 hover:shadow-xl hover:shadow-pink-200 transition-all duration-300 items-center justify-center text-lg gap-2 mt-4 cursor-pointer">
                        Bayar Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    
                    <!-- Secured info -->
                    <div class="flex items-center justify-center gap-2 mt-6 text-zinc-400 text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Pembayaran dienkripsi 256-bit SSL
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QRIS Modal -->
<div id="qris-modal" class="fixed inset-0 z-50 hidden bg-black/50 items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-8 max-w-sm w-full mx-auto text-center border border-rose-100 flex flex-col items-center">
        <h3 class="text-xl font-medium text-zinc-800 mb-2">Scan QRIS</h3>
        <p class="text-sm text-zinc-500 mb-6">Batas waktu pembayaran <span id="countdown" class="font-bold text-pink-500">15:00</span></p>
        <div class="bg-rose-50 p-4 border border-rose-100 rounded-xl mb-6">
            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" alt="Dummy QRIS" class="w-48 h-48">
        </div>
        <button type="button" onclick="document.getElementById('checkout-form').submit()" class="w-full bg-zinc-800 text-white py-3 rounded-full font-medium hover:bg-pink-500 shadow-lg transition-all">
            Saya Sudah Bayar
        </button>
    </div>
</div>
<script>
    let countdownInterval;
    function handlePaymentSubmit() {
        let method = document.querySelector('input[name="payment_method"]:checked').value;
        if (method === 'qris') {
            document.getElementById('qris-modal').classList.remove('hidden');
            document.getElementById('qris-modal').classList.add('flex');
            let time = 15 * 60;
            countdownInterval = setInterval(() => {
                let m = Math.floor(time / 60);
                let s = time % 60;
                document.getElementById('countdown').innerText = (m < 10 ? '0' : '') + m + ':' + (s < 10 ? '0' : '') + s;
                if (time <= 0) clearInterval(countdownInterval);
                time--;
            }, 1000);
        } else {
            document.getElementById('checkout-form').submit();
        }
    }
    function updateQuantity(itemId, change, max, price) {
        let qtyInput = document.getElementById('qty_' + itemId);
        let newQty = parseInt(qtyInput.value) + change;
        
        if (newQty < 1) newQty = 1;
        if (newQty > max) newQty = max;
        
        if (newQty === parseInt(qtyInput.value)) return;
        
        qtyInput.value = newQty;
        document.getElementById('label_qty_' + itemId).innerText = newQty;
        
        // Update DB if not temp
        if (itemId !== 'temp') {
            fetch('/cart/update/' + itemId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({quantity: newQty})
            });
        }
        
        calculateTotal();
    }
    
    function calculateTotal() {
        let total = 0;
        let qtyInputs = document.querySelectorAll('input[id^="qty_"]');
        qtyInputs.forEach(input => {
            let qty = parseInt(input.value);
            let price = parseInt(input.dataset.price);
            total += (qty * price);
        });
        
        let formatter = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });
        let formattedTotal = formatter.format(total).replace('Rp', 'Rp ');
        
        document.getElementById('display_subtotal').innerText = formattedTotal;
        document.getElementById('display_total').innerText = formattedTotal;
    }
</script>
@endsection
