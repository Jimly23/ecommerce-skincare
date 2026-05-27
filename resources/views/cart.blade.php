@extends('layouts.app')

@section('title', 'Keranjang Belanja | AuraGlow')

@section('content')
<div class="bg-rose-50/10 py-12 min-h-screen border-t border-rose-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="text-3xl font-serif text-zinc-800 mb-8 font-medium">Keranjang Belanja</h1>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-rose-100">
                    <div class="hidden sm:grid sm:grid-cols-12 text-sm text-zinc-500 font-medium mb-4 pb-4 border-b border-rose-50 px-2 uppercase tracking-wide">
            <div class="col-span-1 text-center">Pilih</div>
                        <div class="col-span-5">Produk</div>
                        <div class="col-span-3 text-center">Kuantitas</div>
                        <div class="col-span-3 text-right">Subtotal</div>
                    </div>

                    <form id="cart-form" action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    @php $totalPrice = 0; @endphp
                    @forelse($items as $item)
                        @php 
                            $prod = $item->product; 
                            $itemTotal = $prod->price * $item->quantity;
                            $totalPrice += $itemTotal;
                        @endphp
                        <div class="grid grid-cols-1 sm:grid-cols-12 items-center gap-4 py-6 border-b border-rose-50 last:border-0 relative group">
                            
                            <!-- Delete Button (Top Right on Mobile, Left on Desktop hover) -->
                            <a href="{{ route('cart.remove', $item->id) }}" class="absolute -top-2 -right-2 sm:top-1/2 sm:-left-3 sm:-translate-y-1/2 w-8 h-8 bg-red-100 text-red-500 rounded-full flex items-center justify-center sm:opacity-0 sm:group-hover:opacity-100 transition z-10 hover:bg-red-500 hover:text-white" title="Hapus Produk">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </a>

                            <div class="col-span-1 flex items-center justify-center">
                                <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" checked onchange="recalculateCartTotal()" class="w-5 h-5 text-pink-500 border-rose-300 rounded focus:ring-pink-500">
                            </div>

                            <div class="col-span-5 flex items-center gap-4">
                                <div class="w-24 h-24 rounded-2xl overflow-hidden shrink-0 border border-rose-100 relative">
                                    @if(is_array($prod->images) && count($prod->images) > 0)
                                        <img src="{{ Storage::url($prod->images[0]) }}" alt="{{ $prod->name }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1629198688000-71f23e745b6e?auto=format&fit=crop&w=150&q=80" alt="Produk" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-base font-medium text-zinc-800 line-clamp-1 mb-1"><a href="{{ route('shop.show', $prod->id) }}" class="hover:text-pink-500 transition">{{ $prod->name }}</a></h3>
                                    <p class="text-sm text-zinc-500 mb-2 font-light">Rp {{ number_format($prod->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            
                            <div class="col-span-3 flex justify-start sm:justify-center">
                                <div class="flex items-center border border-rose-200 rounded-full bg-rose-50/50 px-2 h-10 w-28 justify-between">
                                    <button type="button" onclick="updateCartQuantity('{{ $item->id }}', -1, {{ $prod->stock }}, {{ $prod->price }})" class="w-6 h-6 flex items-center justify-center text-zinc-400 hover:text-pink-500 transition pb-0.5 font-bold">-</button>
                                    <span class="text-zinc-800 font-medium text-sm w-4 text-center" id="cart_qty_display_{{ $item->id }}">{{ $item->quantity }}</span>
                                    <input type="hidden" id="cart_qty_{{ $item->id }}" value="{{ $item->quantity }}">
                                    <button type="button" onclick="updateCartQuantity('{{ $item->id }}', 1, {{ $prod->stock }}, {{ $prod->price }})" class="w-6 h-6 flex items-center justify-center text-zinc-400 hover:text-pink-500 transition pb-0.5 font-bold">+</button>
                                </div>
                            </div>

                            <div class="col-span-3 text-right">
                                <span class="text-sm sm:hidden text-zinc-500 mr-2">Subtotal:</span>
                                <span class="text-lg font-semibold text-zinc-800" id="cart_subtotal_{{ $item->id }}">Rp {{ number_format($itemTotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16">
                            <div class="w-24 h-24 bg-rose-50 rounded-full flex items-center justify-center mx-auto mb-4 text-pink-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <h3 class="text-lg font-medium text-zinc-800 mb-2">Keranjang Anda kosong</h3>
                            <p class="text-zinc-500 mb-6 font-light">Sepertinya Anda belum memilih produk kebanggaan kami.</p>
                            <a href="/shop" class="inline-block bg-zinc-800 text-white px-8 py-3 rounded-full hover:bg-pink-500 transition shadow-lg">Mulai Belanja</a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Ringkasan -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-rose-100 sticky top-28">
                    <h2 class="text-lg font-medium text-zinc-800 mb-6">Ringkasan Belanja</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-zinc-600 font-light">
                            <span>Total Harga <span id="cart_total_items">({{ $items->count() }} Produk)</span></span>
                            <span id="cart_total_price">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-zinc-600 font-light">
                            <span>Diskon Produk</span>
                            <span class="text-pink-500">- Rp 0</span>
                        </div>
                    </div>

                    <div class="border-t border-rose-100 py-4 mb-6">
                        <div class="flex justify-between items-end">
                            <span class="text-base font-medium text-zinc-800">Total Tagihan</span>
                            <span id="cart_grand_total" class="text-2xl font-bold text-zinc-800">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" form="cart-form" id="checkout-btn" class="w-full text-center bg-pink-500 text-white h-14 rounded-full font-medium hover:bg-pink-600 hover:shadow-xl hover:shadow-pink-200 transition-all duration-300 flex items-center justify-center gap-2 {{ $items->isEmpty() ? 'pointer-events-none opacity-50' : '' }}">
                        Lanjutkan ke Checkout
                    </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function updateCartQuantity(itemId, change, max, price) {
        let qtyInput = document.getElementById('cart_qty_' + itemId);
        let currentQty = parseInt(qtyInput.value);
        let newQty = currentQty + change;
        
        if (newQty < 1) newQty = 1;
        if (newQty > max) newQty = max;
        
        if (newQty === currentQty) return;
        
        // Update local DOM right away
        qtyInput.value = newQty;
        document.getElementById('cart_qty_display_' + itemId).innerText = newQty;
        
        let formatter = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });
        let subtotalStr = formatter.format(newQty * price).replace('Rp', 'Rp ');
        document.getElementById('cart_subtotal_' + itemId).innerText = subtotalStr;
        
        recalculateCartTotal();

        // Save to DB
        fetch('/cart/update/' + itemId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({quantity: newQty})
        });
    }

    function recalculateCartTotal() {
        let total = 0;
        let selectedCount = 0;
        let qtys = document.querySelectorAll('input[id^="cart_qty_"]');
        let checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
        
        qtys.forEach((input, index) => {
            if(checkboxes[index].checked) {
                let itemId = input.id.replace('cart_qty_', '');
                let subtext = document.getElementById('cart_subtotal_' + itemId).innerText;
                let pureNumber = subtext.replace(/[^0-9]/g, '');
                total += parseInt(pureNumber);
                selectedCount++;
            }
        });

        let formatter = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });
        let formattedTotal = formatter.format(total).replace('Rp', 'Rp ');
        
        document.getElementById('cart_total_price').innerText = formattedTotal;
        document.getElementById('cart_grand_total').innerText = formattedTotal;
        document.getElementById('cart_total_items').innerText = '(' + selectedCount + ' Produk)';
        
        let checkoutBtn = document.getElementById('checkout-btn');
        if (selectedCount === 0) {
            checkoutBtn.classList.add('opacity-50', 'pointer-events-none');
        } else {
            checkoutBtn.classList.remove('opacity-50', 'pointer-events-none');
        }
    }
    
    // Call once to ensure initial state matches checked boxes
    recalculateCartTotal();
</script>
@endsection
