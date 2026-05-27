@extends('layouts.app')

@section('title', 'Profil Saya | AuraGlow')

@section('content')
<div class="bg-rose-50/10 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row gap-8">
        
        <!-- Sidebar Dashboard User -->
        <aside class="w-full md:w-64 shrink-0">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-rose-100 sticky top-28">
                <!-- Profil Singkat -->
                <div class="flex items-center gap-4 mb-8">
                    @if(Auth::user()->profile_photo)
                        <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-pink-100">
                             <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profil" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-12 h-12 rounded-full bg-pink-100 text-pink-500 flex items-center justify-center text-xl font-serif italic uppercase">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                    @endif
                    <div class="overflow-hidden">
                        <h2 class="text-[15px] font-medium text-zinc-800 truncate">{{ Auth::user()->name }}</h2>
                        <p class="text-xs text-zinc-500">Member Silver</p>
                    </div>
                </div>

                <!-- Menu Navigasi -->
                <nav class="space-y-1">
                    <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-pink-600 bg-rose-50 transition">
                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Profil Saya
                    </a>
                    <a href="/orders" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-zinc-600 hover:bg-rose-50 hover:text-pink-500 transition relative">
                        <svg class="w-5 h-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Pesanan Saya
                    </a>
                </nav>
                
                <div class="mt-8 pt-6 border-t border-rose-100">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm font-medium text-red-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Konten Utama: Ubah Profil -->
        <main class="flex-1">
            <h1 class="text-2xl font-serif italic text-zinc-800 mb-6">Informasi Akun</h1>
            
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

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Data Pribadi -->
                <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-rose-100">
                    <h2 class="text-lg font-medium text-zinc-800 mb-6">Data Diri</h2>
                    
                    <!-- Foto Profil -->
                    <div class="mb-6 flex items-center gap-6">
                         @if(Auth::user()->profile_photo)
                            <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-rose-200 shrink-0">
                                <img id="photo_preview" src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profil" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-20 h-20 rounded-full bg-rose-50 border border-rose-200 flex items-center justify-center shrink-0">
                                <img id="photo_preview" src="" alt="Preview" class="w-full h-full object-cover rounded-full hidden">
                                <svg id="photo_placeholder" class="w-8 h-8 text-rose-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div>
                            <label for="profile_photo" class="cursor-pointer bg-white px-4 py-2 border border-rose-300 rounded-full text-sm font-medium text-pink-500 hover:bg-rose-50 transition">
                                Pilih Foto
                            </label>
                            <input type="file" id="profile_photo" name="profile_photo" class="hidden" accept="image/*" onchange="previewImage(event)">
                            <p class="text-xs text-zinc-400 mt-2 font-light">Format gambar .jpg, .png, atau .webp.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-zinc-700 mb-1.5">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required
                                class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-zinc-700 mb-1.5">Email</label>
                            <input type="email" value="{{ Auth::user()->email }}" disabled
                                class="w-full px-4 py-3 rounded-xl border border-zinc-200 text-sm bg-zinc-50 text-zinc-500 cursor-not-allowed hidden md:block">
                             <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-zinc-700 mb-1.5">Nomor Ponsel</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone) }}"
                                class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition">
                        </div>
                         <div>
                            <label for="gender" class="block text-sm font-medium text-zinc-700 mb-1.5">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="w-full px-4 py-3 border-rose-200 text-zinc-700 text-sm rounded-xl focus:ring-pink-500 focus:border-pink-500 bg-rose-50/30">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('gender', Auth::user()->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender', Auth::user()->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="birthdate" class="block text-sm font-medium text-zinc-700 mb-1.5">Tanggal Lahir</label>
                            <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate', Auth::user()->birthdate ? Auth::user()->birthdate->format('Y-m-d') : '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition">
                        </div>
                    </div>
                </div>

                <!-- Buku Alamat -->
                <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-sm border border-rose-100">
                    <h2 class="text-lg font-medium text-zinc-800 mb-6">Alamat Utama</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="recipient_name" class="block text-sm font-medium text-zinc-700 mb-1.5">Nama Penerima</label>
                            <input type="text" name="recipient_name" id="recipient_name" value="{{ old('recipient_name', Auth::user()->recipient_name) }}"
                                class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition">
                        </div>
                        <div>
                            <label for="recipient_phone" class="block text-sm font-medium text-zinc-700 mb-1.5">Nomor HP Penerima</label>
                            <input type="tel" name="recipient_phone" id="recipient_phone" value="{{ old('recipient_phone', Auth::user()->recipient_phone) }}"
                                class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="address" class="block text-sm font-medium text-zinc-700 mb-1.5">Alamat Lengkap</label>
                            <textarea name="address" id="address" rows="3" 
                                class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition placeholder-zinc-400"
                                placeholder="Nama Jalan, Gedung, No. Rumah...">{{ old('address', Auth::user()->address) }}</textarea>
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-medium text-zinc-700 mb-1.5">Kabupaten / Kota</label>
                            <input type="text" name="city" id="city" value="{{ old('city', Auth::user()->city) }}"
                                class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition">
                        </div>
                        <div>
                            <label for="province" class="block text-sm font-medium text-zinc-700 mb-1.5">Provinsi</label>
                            <input type="text" name="province" id="province" value="{{ old('province', Auth::user()->province) }}"
                                class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition">
                        </div>
                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-zinc-700 mb-1.5">Kode Pos</label>
                            <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', Auth::user()->postal_code) }}"
                                class="w-full px-4 py-3 rounded-xl border border-rose-200 focus:ring-2 focus:ring-pink-500 focus:border-transparent text-sm bg-rose-50/30 transition">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-zinc-800 text-white px-8 py-3.5 rounded-full font-medium hover:bg-pink-500 hover:shadow-xl hover:shadow-pink-200 transition-all duration-300 text-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </main>
    </div>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('photo_preview');
            var placeholder = document.getElementById('photo_placeholder');
            output.src = reader.result;
            output.classList.remove('hidden');
            if(placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
