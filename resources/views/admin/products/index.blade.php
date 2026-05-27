@extends('layouts.admin')

@section('title', 'Manage Products')
@section('header_title', 'Products')

@section('content')
<div class="bg-white rounded-2xl border border-rose-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)] overflow-hidden">
    <div class="p-6 border-b border-rose-100 flex justify-between items-center">
        <h3 class="text-lg font-medium text-zinc-800">All Products</h3>
        <a href="{{ route('admin.products.create') }}" class="bg-pink-500 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-pink-600 transition shadow-lg shadow-pink-500/30 flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Add Product</span>
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-rose-50/50 text-zinc-600 text-sm">
                    <th class="px-6 py-4 font-medium border-b border-rose-100">Image</th>
                    <th class="px-6 py-4 font-medium border-b border-rose-100">Name</th>
                    <th class="px-6 py-4 font-medium border-b border-rose-100">Price</th>
                    <th class="px-6 py-4 font-medium border-b border-rose-100">Stock</th>
                    <th class="px-6 py-4 font-medium border-b border-rose-100">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($products as $product)
                <tr class="border-b border-rose-50 hover:bg-rose-50/30 transition">
                    <td class="px-6 py-4">
                        @if(is_array($product->images) && count($product->images) > 0)
                            <img src="{{ Storage::url($product->images[0]) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-lg border border-rose-100">
                        @else
                            <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 border border-gray-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-medium text-zinc-800">{{ $product->name }}</td>
                    <td class="px-6 py-4 text-zinc-600">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-zinc-600">{{ $product->stock }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-pink-500 hover:text-pink-600 transition p-1 bg-pink-50 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600 transition p-1 bg-red-50 rounded-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-zinc-500">
                        No products found. <a href="{{ route('admin.products.create') }}" class="text-pink-500 hover:underline">Add one now</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
