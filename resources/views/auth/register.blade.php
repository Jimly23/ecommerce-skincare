@extends('layouts.app')

@section('title', 'Daftar Akun | AuraGlow')

@section('content')
<div class="min-h-screen flex items-center justify-center py-16 px-4 bg-rose-50/30">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-10">
            <a href="/" class="text-3xl font-semibold tracking-widest text-zinc-800 uppercase">
                Aura<span class="text-pink-500">Glow</span>
            </a>
            <p class="text-zinc-500 font-light mt-2 text-sm">Buat akun untuk mulai berbelanja</p>
        </div>

        <!-- Card Register -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-rose-100">
            <h2 class="text-xl font-medium text-zinc-800 mb-6">Daftar Akun Baru</h2>

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block text-sm font-medium text-zinc-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition placeholder-zinc-400"
                        placeholder="Masukkan nama lengkap Anda">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-zinc-700 mb-1.5">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition placeholder-zinc-400"
                        placeholder="contoh@email.com">
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-zinc-700 mb-1.5">Nomor Telepon</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition placeholder-zinc-400"
                        placeholder="08xxxxxxxxxx">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-zinc-700 mb-1.5">Kata Sandi</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition placeholder-zinc-400"
                        placeholder="Minimal 6 karakter">
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 mb-1.5">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition placeholder-zinc-400"
                        placeholder="Ulangi kata sandi">
                </div>

                <!-- Tombol Daftar -->
                <button type="submit"
                    class="w-full bg-zinc-800 text-white h-12 rounded-full font-medium hover:bg-pink-500 hover:shadow-xl hover:shadow-pink-200 transition-all duration-300 text-sm">
                    Buat Akun
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center my-6">
                <div class="flex-1 border-t border-rose-100"></div>
                <span class="px-4 text-xs text-zinc-400 font-light">atau</span>
                <div class="flex-1 border-t border-rose-100"></div>
            </div>

            <!-- Link ke Login -->
            <p class="text-center text-sm text-zinc-600 font-light">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-pink-500 font-medium hover:text-pink-600 transition">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection
