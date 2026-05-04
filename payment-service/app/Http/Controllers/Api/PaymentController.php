<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function index()
    {
        return response()->json(Transaction::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'price' => 'required|numeric',
        ]);

        $transaction = Transaction::create([
            'idOrder' => $request->order_id,
            'total_harga' => $request->price,
            'status_pembayaran' => 'PENDING',
        ]);

        $qrData = "PAYMENT-ORDER-" . $request->order_id . "-" . $request->price;
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . $qrData;

        return response()->json([
            'message' => 'QRIS Generated Successfully',
            'data' => $transaction,
            'qris_url' => $qrUrl
        ], 201);
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }
        return response()->json($transaction, 200);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status_pembayaran === 'SUCCESS') {
            return $request->wantsJson()
                ? response()->json(['message' => 'Transaksi sudah lunas'], 200)
                : redirect('/admin-payment')->with('success', 'Transaksi ini memang sudah lunas.');
        }

        $transaction->update(['status_pembayaran' => 'SUCCESS']);

        try {
            $response = Http::withoutVerifying()
                ->timeout(5)
                ->post("http://127.0.0.1:8000/api/payment-callback", [
                    'order_id' => $transaction->idOrder,
                    'status'   => 'success'
                ]);

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Pembayaran dikonfirmasi & Callback terkirim!',
                    'order_service_response' => $response->json()
                ], 200);
            }

            return redirect('/admin-payment')->with('success', 'Pembayaran Berhasil Dikonfirmasi!');

        } catch (\Exception $e) {
            
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Koneksi ke Order Service Gagal'], 500);
            }

            return redirect('/admin-payment')->with('error', 'Gagal kirim notifikasi ke Order Service. Pastikan Port 8000 nyala!');
        }
    }


public function confirm(Request $request)
{

    $response = Http::withoutVerifying()->timeout(3)->post('http://127.0.0.1:8000/api/payment-callback', [
        'order_id' => $request->order_id,
        'status' => 'success'
    ]);

    return response()->json([
        'message' => 'Konfirmasi pembayaran dikirim ke Order Service',
        'order_response' => $response->json()
    ]);
}
}
