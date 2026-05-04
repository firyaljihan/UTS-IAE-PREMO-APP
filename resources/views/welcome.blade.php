<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>premo.id</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#fcfcfd] text-slate-900 antialiased selection:bg-rose-100 selection:text-rose-900">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/70 backdrop-blur-xl border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <!-- Logo & Premo.id -->
            <div class="flex items-center gap-2.5">
                <div
                    class="w-10 h-10 bg-gradient-to-tr from-rose-500 to-fuchsia-600 rounded-xl flex items-center justify-center shadow-lg shadow-rose-500/20 transform rotate-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                        </path>
                    </svg>
                </div>
                <span class="text-xl font-[800] tracking-tighter text-slate-900">premo<span
                        class="text-rose-600">.id</span></span>
            </div>

            <!-- Menu floating -->
            <div class="flex items-center gap-4">
                @auth
                    <div class="hidden md:flex flex-col items-end mr-2">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Active Account</span>
                        <span class="text-sm font-bold text-slate-700">{{ Auth::user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="group flex items-center gap-2 bg-slate-50 hover:bg-rose-50 px-5 py-2.5 rounded-full border border-slate-200 hover:border-rose-200 transition-all">
                            <span
                                class="text-xs font-bold text-slate-600 group-hover:text-rose-600 uppercase tracking-wider">Logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-bold text-slate-600 hover:text-rose-600 px-4 transition-colors">Login</a>
                    <a href="{{ route('register') }}"
                        class="bg-slate-900 text-white text-sm font-bold px-7 py-3 rounded-full hover:bg-rose-600 transition-all shadow-xl shadow-slate-900/10 active:scale-95">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="pt-32 pb-24 px-6">
        <div class="max-w-7xl mx-auto">

            <!-- Minimalist Hero -->
            <div class="text-center mb-20">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-rose-50 border border-rose-100 mb-6">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                    </span>
                    <span class="text-[11px] font-black text-rose-600 uppercase tracking-[0.2em]">100% Legal &
                        Bergaransi</span>
                </div>
                <h1 class="text-5xl md:text-7xl font-[800] text-slate-900 tracking-tight mb-6">
                    Semua Akun <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-rose-500 to-fuchsia-600">Premium</span><br
                        class="hidden md:block"> Ada Disini!
                </h1>
                <p class="text-slate-500 text-lg max-w-2xl mx-auto leading-relaxed font-medium">
                    Satu platform untuk semua kebutuhan digitalmu. Bayar sekali, nikmati sepuasnya!
                </p>
            </div>

            <!-- Catalog grid -->
            @if (empty($apps) || count($apps) == 0)
                <div
                    class="bg-white p-16 rounded-[3rem] border border-slate-100 shadow-[0_20px_50px_-20px_rgba(0,0,0,0.05)] text-center max-w-3xl mx-auto animate-[translateY_0.5s_ease-out]">
                    <div
                        class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-8 text-slate-300 border border-slate-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-[800] text-slate-900 mb-3 tracking-tight">Koneksi Catalog Terputus</h3>
                    <p class="text-slate-400 font-medium leading-relaxed max-w-md mx-auto">
                        Ups! premo.id tidak bisa menjangkau layanan katalog. <br>
                        <span class="text-rose-500 font-bold italic">Pastikan API catalog service terhubung.</span>
                    </p>
                    <button onclick="window.location.reload()"
                        class="mt-8 bg-slate-900 hover:bg-rose-600 text-white font-black py-4 px-8 rounded-2xl transition-all active:scale-95 text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-slate-900/10">
                        Coba Hubungkan Ulang
                    </button>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach ($apps as $app)
                        <div
                            class="group relative flex flex-col bg-white rounded-[2.5rem] border border-slate-100 p-8 hover:border-rose-100 hover:shadow-[0_30px_60px_-15px_rgba(225,29,72,0.1)] transition-all duration-500">

                            <!-- Badge Ready Stok (Premo Style) -->
                            <div class="absolute top-6 right-6">
                                <span
                                    class="inline-flex items-center gap-1.5 bg-rose-50/50 text-rose-600 text-[9px] font-black px-3 py-1.5 rounded-full uppercase tracking-wider border border-rose-100/50">
                                    <span class="relative flex h-2 w-2">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                                    </span>
                                    Ready
                                </span>
                            </div>

                            <!-- Visual Inisial -->
                            <div
                                class="w-16 h-16 rounded-2xl bg-gradient-to-br from-rose-500 to-fuchsia-600 flex items-center justify-center text-white text-3xl font-black shadow-lg shadow-rose-500/30 mb-8 transform group-hover:-translate-y-1 group-hover:rotate-3 transition-all duration-500">
                                {{ substr($app['nama_app'], 0, 1) }}
                            </div>

                            <!-- Info Produk -->
                            <div class="flex-grow">
                                <h3
                                    class="text-2xl font-[800] text-slate-900 mb-2 tracking-tight group-hover:text-rose-600 transition-colors">
                                    {{ $app['nama_app'] }}
                                </h3>
                                <p class="text-slate-500 text-sm leading-relaxed mb-8 font-medium line-clamp-2">
                                    {{ $app['snk'] }}
                                </p>
                            </div>

                            <!-- Bagian Harga & Tombol -->
                            <div class="mt-auto pt-8 border-t border-slate-50 flex items-end justify-between">
                                <div>
                                    <p class="text-[10px] font-black text-rose-500 uppercase tracking-[0.15em] mb-1">
                                        Mulai dari</p>
                                    <div class="flex items-baseline gap-0.5">
                                        <span class="text-sm font-bold text-slate-900">Rp</span>
                                        <span class="text-3xl font-[900] text-slate-900 tracking-tighter">
                                            {{ number_format($app['harga'], 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>

                                <form action="/checkout" method="POST" class="flex items-center gap-3">
                                    @csrf
                                    <input type="hidden" name="app_id" value="{{ $app['id'] }}">
                                    <input type="hidden" name="app_name" value="{{ $app['nama_app'] }}">
                                    <input type="hidden" name="price" value="{{ $app['harga'] }}">

                                    <!-- Input Qty Estetik -->
                                    <div class="flex flex-col items-end">
                                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Qty</label>
                                        <input type="number" name="qty" value="1" min="1" max="10"
                                            class="w-14 px-2 py-2 rounded-xl border border-slate-100 bg-slate-50 text-xs font-bold text-center focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all">
                                    </div>

                                    <button type="submit"
                                        class="bg-slate-900 text-white p-4 rounded-2xl hover:bg-rose-600 transition-all active:scale-90 shadow-xl shadow-slate-900/10 group-hover:shadow-rose-600/20">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>

</body>

</html>
