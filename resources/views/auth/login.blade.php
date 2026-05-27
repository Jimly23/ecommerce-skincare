@extends('layouts.app')

@section('title', 'Masuk | AuraGlow')

@section('content')
<div class="min-h-screen flex items-center justify-center py-16 px-4 bg-rose-50/30">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-10">
            <a href="/" class="text-3xl font-semibold tracking-widest text-zinc-800 uppercase">
                Aura<span class="text-pink-500">Glow</span>
            </a>
            <p class="text-zinc-500 font-light mt-2 text-sm">Selamat datang kembali! Silakan masuk ke akun Anda.</p>
        </div>

        <!-- Card Login -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-rose-100">
            <h2 class="text-xl font-medium text-zinc-800 mb-6">Masuk</h2>

            {{-- Error & Success Messages --}}
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-zinc-700 mb-1.5">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition placeholder-zinc-400"
                        placeholder="contoh@email.com">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-zinc-700 mb-1.5">Kata Sandi</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition placeholder-zinc-400"
                        placeholder="Masukkan kata sandi Anda">
                </div>
                
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-pink-500 bg-rose-50 border-rose-200 rounded focus:ring-pink-500 focus:ring-2">
                        <span class="ml-2 text-sm text-zinc-600 font-light">Ingat saya</span>
                    </label>
                    
                    <a href="#" class="text-sm text-pink-500 hover:text-pink-600 transition font-medium">Lupa sandi?</a>
                </div>

                <!-- Tombol Masuk -->
                <button type="submit"
                    class="w-full bg-zinc-800 text-white h-12 rounded-full font-medium hover:bg-pink-500 hover:shadow-xl hover:shadow-pink-200 transition-all duration-300 text-sm mt-4">
                    Masuk
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center my-6">
                <div class="flex-1 border-t border-rose-100"></div>
                <span class="px-4 text-xs text-zinc-400 font-light">atau</span>
                <div class="flex-1 border-t border-rose-100"></div>
            </div>

            <!-- Link ke Register -->
            <p class="text-center text-sm text-zinc-600 font-light">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-pink-500 font-medium hover:text-pink-600 transition">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection
