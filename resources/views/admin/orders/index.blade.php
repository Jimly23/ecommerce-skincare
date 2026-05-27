@extends('layouts.admin')

@section('title', 'Daftar Pesanan')
@section('header_title', 'Daftar Pesanan')

@section('content')
<div class="bg-white rounded-2xl border border-rose-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)] overflow-hidden">
    <div class="px-6 py-4 border-b border-rose-100 block md:flex justify-between items-center">
        <h3 class="text-lg font-medium text-zinc-800">Semua Pesanan</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-rose-50/50">
                    <th class="px-6 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider border-b border-rose-100">ID Pesanan</th>
                    <th class="px-6 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider border-b border-rose-100">Pelanggan</th>
                    <th class="px-6 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider border-b border-rose-100">Total</th>
                    <th class="px-6 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider border-b border-rose-100">Metode Bayar</th>
                    <th class="px-6 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider border-b border-rose-100">Status</th>
                    <th class="px-6 py-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider border-b border-rose-100">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-rose-100">
                @forelse($orders as $order)
                <tr class="hover:bg-rose-50/30 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-800 font-medium">{{ $order->invoice_number }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">{{ $order->user->name ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600 uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 rounded-full text-xs font-medium 
                            {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $order->status == 'paid' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $order->status == 'processing' ? 'bg-purple-100 text-purple-700' : '' }}
                            {{ $order->status == 'shipping' ? 'bg-orange-100 text-orange-700' : '' }}
                            {{ $order->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                        ">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PUT')
                            <select name="status" class="border border-rose-200 rounded-lg text-sm px-2 py-1 focus:ring-pink-500 focus:border-pink-500 bg-white">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Di Proses</option>
                                <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Dalam Pengiriman</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            <button type="submit" class="bg-pink-500 text-white px-3 py-1 rounded-lg hover:bg-pink-600 transition text-xs shadow-sm shadow-pink-500/30">Simpan</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-zinc-500 text-sm">Tidak ada pesanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
