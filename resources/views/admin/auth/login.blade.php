<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - AuraGlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { pink: { 400: '#f472b6', 500: '#ec4899' }, rose: { 50: '#fff1f2', 100: '#ffe4e6' }, zinc: { 800: '#27272a' } } } }
        }
    </script>
</head>
<body class="bg-rose-50/50 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-rose-100">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-semibold tracking-widest text-zinc-800 uppercase mb-2">Admin<span class="text-pink-500">Panel</span></h1>
            <p class="text-gray-500 font-light text-sm">Masuk ke dashboard Admin AuraGlow</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-500 p-4 rounded-xl mb-6 text-sm border border-red-100">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 rounded-xl border border-rose-200 bg-rose-50/50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 rounded-xl border border-rose-200 bg-rose-50/50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all">
            </div>
            <button type="submit" class="w-full bg-pink-500 text-white font-medium py-2.5 rounded-xl hover:bg-pink-600 transition shadow-lg shadow-pink-500/30">
                Login
            </button>
        </form>
    </div>
</body>
</html>
