<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Payment - premo.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-slate-50 p-6 md:p-12">
    <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

        <!-- Header -->
        <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-white">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Admin Payment</h1>
                <p class="text-sm text-slate-500 mt-1">Konfirmasi dan Monitoring Transaksi Gateway</p>
            </div>
            <div class="text-right">
                <span class="text-[10px] font-bold text-rose-600 uppercase tracking-widest bg-rose-50 px-3 py-1 rounded-full border border-rose-100">
                    System Active
                </span>
            </div>
        </div>

        <!-- Alert Notifikasi -->
        @if(session('success'))
            <div class="m-8 mb-0 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl text-sm font-semibold flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Transaksi -->
        <div class="p-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[11px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                            <th class="pb-4 px-4">Order ID</th>
                            <th class="pb-4 px-4">Total Harga</th>
                            <th class="pb-4 px-4">Status</th>
                            <th class="pb-4 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($transactions as $trx)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-5 px-4">
                                <span class="font-mono text-xs font-bold text-slate-700">
                                    #ORD-{{ str_pad($trx->idOrder, 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td class="py-5 px-4">
                                <span class="text-sm font-bold text-slate-900">
                                    Rp{{ number_format($trx->total_harga, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="py-5 px-4">
                                @if($trx->status_pembayaran == 'SUCCESS')
                                    <span class="inline-flex items-center gap-1.5 text-emerald-600 text-[10px] font-bold uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Lunas
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-amber-500 text-[10px] font-bold uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Menunggu
                                    </span>
                                @endif
                            </td>
                            <td class="py-5 px-4 text-right">
                                @if($trx->status_pembayaran !== 'SUCCESS')
                                    <form action="/api/payment/{{ $trx->id }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-slate-900 hover:bg-rose-600 text-white px-5 py-2 rounded-xl text-[11px] font-bold uppercase tracking-tight transition-all active:scale-95 shadow-sm">
                                            Konfirmasi Bayar
                                        </button>
                                    </form>
                                @else
                                    <span class="text-slate-300 text-[11px] font-bold uppercase italic px-5">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
