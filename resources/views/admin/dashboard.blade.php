@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header_title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Stat Card -->
    <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)] focus-within:ring-2 transform hover:-translate-y-1 transition duration-300">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-pink-50 text-pink-500 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <p class="text-zinc-500 text-sm">Total Products</p>
                <h3 class="text-2xl font-bold text-zinc-800">{{ $productCount }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 bg-white p-6 rounded-2xl border border-rose-100 shadow-[0_4px_20px_rgb(0,0,0,0.03)]">
    <h3 class="text-lg font-medium text-zinc-800 mb-4">Welcome back, {{ Auth::guard('admin')->user()->name }}!</h3>
    <p class="text-zinc-500">Use the sidebar to navigate through the admin panel.</p>
</div>
@endsection
