@extends('layouts.app')
@section('title', 'Kategori Produk | AuraGlow')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-serif italic text-zinc-800 mb-8">Kategori Produk</h1>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @php
            $defaultCategories = ['Parfum', 'Micellar Water', 'Skincare', 'Makeup', 'Haircare', 'Bodycare'];
            $allCategories = $categories->isEmpty() ? collect($defaultCategories) : $categories->merge($defaultCategories)->unique();
        @endphp
        @foreach($allCategories as $cat)
        <a href="{{ route('shop.index', ['category' => $cat]) }}" class="bg-rose-50 p-6 rounded-2xl text-center hover:bg-pink-500 hover:text-white transition-all group shadow-sm flex flex-col items-center justify-center min-h-[160px]">
            <h3 class="text-xl font-medium text-pink-500 group-hover:text-white mb-2">{{ $cat }}</h3>
            <p class="text-sm font-light text-zinc-500 group-hover:text-pink-100">Jelajahi Produk</p>
        </a>
        @endforeach
    </div>
</div>
@endsection
