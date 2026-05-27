<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request, \App\Models\Product $product)
    {
        $cart = \App\Models\Cart::firstOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $product->id],
            ['quantity' => 0]
        );
        $cart->increment('quantity');
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, \App\Models\Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) abort(403);
        $request->validate(['quantity' => 'required|integer|min:1']);
        $cart->update(['quantity' => $request->quantity]);
        return response()->json(['success' => true]);
    }
    
    public function remove(\App\Models\Cart $cart)
    {
        if ($cart->user_id === auth()->id()) {
            $cart->delete();
        }
        return redirect()->back();
    }
}
