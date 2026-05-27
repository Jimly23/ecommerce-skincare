@extends('layouts.app')

@section('title', 'Menunggu Pembayaran | AuraGlow')

@section('content')
<div class="bg-rose-50/10 py-12 min-h-[70vh] flex flex-col justify-center items-center">
    <div class="max-w-md w-full mx-auto px-4 sm:px-6">
        
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-rose-100 text-center relative overflow-hidden">
            <!-- Dekorasi latar -->
            <div class="absolute top-0 right-0 -mt-6 -mr-6 w-24 h-24 bg-pink-100 rounded-full blur-2xl opacity-50"></div>
            <div class="absolute bottom-0 left-0 -mb-6 -ml-6 w-24 h-24 bg-rose-100 rounded-full blur-2xl opacity-50"></div>

            <div class="relative z-10">
                <div class="w-16 h-16 bg-rose-100 text-pink-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                
                <h1 class="text-2xl font-serif italic text-zinc-900 mb-2">Menunggu Pembayaran</h1>
                <p class="text-sm text-zinc-500 font-light mb-8">Segera selesaikan pembayaran Anda sebelum waktu habis.</p>
                
                <div class="bg-rose-50 border border-rose-100 rounded-2xl py-6 mb-6">
                    <p class="text-xs uppercase tracking-widest text-zinc-500 mb-1">Batas Waktu</p>
                    <div id="countdown" class="text-4xl font-mono font-bold text-pink-500 tracking-wider">
                        05:00
                    </div>
                </div>

                <div class="border-t border-b border-rose-50 py-4 mb-8 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-zinc-500 font-light">Total Pembayaran</span>
                        <span class="text-zinc-800 font-bold">Rp {{ isset($totalPrice) ? number_format($totalPrice, 0, ',', '.') : '0' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-500 font-light">No. Virtual Account / Order</span>
                        <span class="text-zinc-800 font-medium tracking-wider">{{ $transaction->invoice_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-500 font-light">Metode</span>
                        <span class="text-zinc-800 font-medium uppercase">{{ strtoupper(str_replace('_', ' ', $transaction->payment_method)) }}</span>
                    </div>
                </div>

                <button type="button" onclick="confirmPayment()" class="w-full bg-zinc-800 text-white h-14 rounded-full font-medium hover:bg-pink-500 hover:shadow-xl hover:shadow-pink-200 transition-all duration-300 text-lg">
                    Saya Sudah Bayar
                </button>
            </div>
        </div>

    </div>
</div>

<!-- Modal / Popup Alert (Hidden by default) -->
<div id="successPopup" class="fixed inset-0 z-50 hidden">
    <!-- Backdrop overlay -->
    <div class="absolute inset-0 bg-zinc-900/40 backdrop-blur-sm"></div>
    
    <!-- Modal content -->
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-3xl p-8 max-w-sm w-full mx-4 shadow-2xl text-center border border-rose-100">
        <div class="w-20 h-20 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 scale-90 transition-transform duration-500" id="successIcon">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <h2 class="text-2xl font-serif italic text-zinc-900 mb-2">Pembayaran Berhasil!</h2>
        <p class="text-zinc-500 text-sm font-light mb-8">Terima kasih, pesanan Anda sedang kami proses dan siap untuk dikemas.</p>
        
        <form action="{{ route('payment.confirm') }}" method="POST">
            @csrf
            <input type="hidden" name="ids" value="{{ implode(',', $ids) }}">
            <button type="submit" class="block w-full bg-pink-500 text-white py-3.5 rounded-full font-medium hover:bg-pink-600 transition shadow-md shadow-pink-200">
                Lihat Pesanan Saya
            </button>
        </form>
    </div>
</div>

<script>
    // Countdown Timer 5 menit (300 detik)
    let time = 300;
    const countdownEl = document.getElementById('countdown');
    
    const countInterval = setInterval(() => {
        let min = Math.floor(time / 60);
        let sec = time % 60;
        
        min = min < 10 ? '0' + min : min;
        sec = sec < 10 ? '0' + sec : sec;
        
        countdownEl.innerText = `${min}:${sec}`;
        time--;
        
        if (time < 0) {
            clearInterval(countInterval);
            countdownEl.innerText = '00:00';
            countdownEl.classList.replace('text-pink-500', 'text-red-500');
        }
    }, 1000);

    // Fungsi konfirmasi pembayaran untuk menampilkan popup modal
    function confirmPayment() {
        const popup = document.getElementById('successPopup');
        const icon = document.getElementById('successIcon');
        
        // Remove hidden
        popup.classList.remove('hidden');
        
        // Add minimal animation
        setTimeout(() => {
            icon.classList.remove('scale-90');
            icon.classList.add('scale-100');
        }, 50);
    }
</script>
@endsection
