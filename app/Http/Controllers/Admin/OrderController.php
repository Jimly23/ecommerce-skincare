<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Transaction::with('user', 'items.product')->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required|string|in:pending,paid,processing,shipping,completed,cancelled'
        ]);
        
        $transaction->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
