<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#fcfcfd] text-slate-900 antialiased min-h-screen flex items-center justify-center p-6 relative overflow-hidden">

    <!-- Efek Latar Belakang -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-rose-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-fuchsia-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    </div>

    <!-- Container Tiket (Dilebarkan dikit biar muat sampingan) -->
    <div class="w-full max-w-2xl relative z-10 animate-[translateY_0.5s_ease-out]">

        <!-- BAGIAN ATAS TIKET -->
        <div class="bg-white rounded-t-[2.5rem] p-10 border border-slate-100 border-b-0 shadow-[0_20px_50px_-20px_rgba(0,0,0,0.05)]">
            <div class="flex flex-col md:flex-row gap-10">

                <!-- Sisi Kiri: Rincian -->
                <div class="flex-1">
                    <div class="flex items-center gap-2.5 mb-8 pb-6 border-b border-slate-50">
                        <div class="w-10 h-10 bg-gradient-to-tr from-rose-500 to-fuchsia-600 rounded-xl flex items-center justify-center shadow-lg shadow-rose-500/20 transform rotate-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-[800] tracking-tighter text-slate-900">premo<span class="text-rose-600">.id</span></span>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">Total Tagihan</p>
                            <h1 class="text-4xl font-[800] text-slate-900 tracking-tighter">
                                <span class="text-xl font-bold text-rose-600 mr-1">Rp</span>{{ number_format($order->total_price, 0, ',', '.') }}
                            </h1>
                        </div>

                        <div class="p-6 bg-[#fcfcfd] rounded-3xl border border-slate-100 space-y-4">
                            <div class="flex justify-between items-center border-b border-slate-200/50 pb-3">
                                <span class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Referensi</span>
                                <span class="text-xs font-black text-slate-900 tracking-wider">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1.5">Layanan:</span>
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-rose-500"></div>
                                    <span class="text-sm font-extrabold text-slate-800">{{ $order->app_name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sisi Kanan: QRIS (Pindah ke samping rincian) -->
                <div class="w-full md:w-64 flex flex-col items-center justify-center">
                    @if ($order->qris_url)
                        <div class="inline-block p-4 bg-white border border-slate-100 rounded-[2rem] shadow-sm mb-4 relative group">
                            @if ($order->status == 'success')
                                <div class="absolute inset-0 bg-white/90 backdrop-blur-sm rounded-[2rem] flex items-center justify-center z-10">
                                    <div class="bg-emerald-500 text-white p-3 rounded-full shadow-lg">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </div>
                            @endif
                            <img src="{{ $order->qris_url }}" alt="QRIS" class="w-40 h-40 rounded-xl object-cover">
                        </div>
                        <p class="text-[9px] text-slate-400 font-black uppercase tracking-[0.2em] text-center leading-relaxed">
                            Pindai QRIS untuk<br>menyelesaikan pembayaran
                        </p>
                    @else
                        <div class="w-40 h-40 flex flex-col items-center justify-center bg-slate-50 border border-dashed border-slate-200 rounded-[2rem] text-slate-300">
                            <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <span class="text-[8px] font-black uppercase tracking-widest text-center px-4">Koneksi Payment Bermasalah</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Garis Pemisah Sobekan -->
        <div class="relative h-10 bg-white flex items-center border-x border-slate-100">
            <div class="absolute left-0 w-5 h-10 bg-[#fcfcfd] rounded-r-full -ml-[1px] border border-l-0 border-slate-100 shadow-inner"></div>
            <div class="w-full border-t-[2.5px] border-dashed border-slate-100 mx-6"></div>
            <div class="absolute right-0 w-5 h-10 bg-[#fcfcfd] rounded-l-full -mr-[1px] border border-r-0 border-slate-100 shadow-inner"></div>
        </div>

        <!-- BAGIAN BAWAH TIKET -->
        <div class="bg-white rounded-b-[2.5rem] p-10 border border-slate-100 border-t-0 shadow-[0_40px_80px_-30px_rgba(0,0,0,0.08)]">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex flex-col items-center md:items-start">
                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Status Pembayaran</span>
                    @if ($order->status == 'pending')
                        <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-600 px-3.5 py-1.5 rounded-full text-[10px] font-black tracking-widest uppercase border border-amber-100 animate-pulse">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-600 px-3.5 py-1.5 rounded-full text-[10px] font-black tracking-widest uppercase border border-emerald-100">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Lunas
                        </span>
                    @endif
                </div>

                <div class="flex gap-3 w-full md:w-auto">
                    <button onclick="window.location.reload()" class="flex-1 md:flex-none bg-slate-900 hover:bg-rose-600 text-white font-black py-4 px-8 rounded-2xl transition-all active:scale-95 text-[10px] uppercase tracking-widest shadow-xl">Status</button>
                    <a href="/" class="flex-1 md:flex-none bg-slate-50 hover:bg-slate-100 text-slate-500 font-black py-4 px-8 rounded-2xl transition-all text-[10px] uppercase tracking-widest border border-slate-100 text-center">Home</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes translateY {
            0% { transform: translateY(30px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
    </style>
</body>
</html>
