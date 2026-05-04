<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;

class OrderController extends Controller
{
   public function index()
    {
        $catalogApiUrl = 'http://127.0.0.1:8001/api/products-list';
        $apps = [];

        try {
            $response = Http::withoutVerifying()->timeout(3)->get($catalogApiUrl);
            if ($response->successful()) {
                $apps = $response->json();
            }
        } catch (\Exception $e) {
            $apps = [];
        }

        return view('welcome', compact('apps'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'app_id' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|integer|min:1',
        ]);

        $totalPrice = $request->price * $request->qty;

        $order = Order::create([
            'user_id' => auth()->id(),
            'app_id' => $request->app_id,
            'app_name' => $request->app_name,
            'price' => $request->price,
            'qty' => $request->qty,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        try {
            $response = Http::withoutVerifying()->timeout(10)->post('http://127.0.0.1:8002/api/qris', [
                'order_id' => $order->id,
                'price' => $totalPrice
            ]);

            $qrisUrl = $response->successful() ? $response->json()['qris_url'] : null;
        } catch (\Exception $e) {
            $qrisUrl = null;
        }

        $order->update(['qris_url' => $qrisUrl]);
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Order created successfully!',
                'order' => $order,
                'payment_url' => $qrisUrl
            ], 201);
        }
        return redirect()->route('invoice.show', $order->id);
    }

    public function paymentCallback(Request $request)
    {
        $orderId = $request->input('order_id');
        $order = Order::where('id', $orderId)->first();

        if (!$order) {
            return response()->json([
                'message' => 'Order tetap tidak ditemukan di DB',
                'debug_id_yang_dicari' => $orderId,
                'data_request' => $request->all(),
                'database_aktif' => config('database.connections.mysql.database')
            ], 404);
        }

        if ($request->input('status') == 'success') {
            try {
                $response = Http::withoutVerifying()->timeout(10)->post('http://127.0.0.1:8001/api/get-stock', [
                    'product_id' => $order->app_id,
                    'qty' => $order->qty
                ]);

                if ($response->successful()) {
                    $accounts = $response->json();
                    foreach ($accounts as $acc) {
                        OrderDetail::create([
                            'order_id' => $order->id,
                            'email'    => $acc['email_premium'] ?? $acc['email'],
                            'password' => $acc['password_premium'] ?? $acc['password'],
                            'profile'  => $acc['profile_name'] ?? $acc['profile'],
                            'pin'      => $acc['pin'] ?? null
                        ]);
                    }

                    $order->update([
                        'status' => 'success',
                        'expired_at' => Carbon::now()->addDays(30)
                    ]);

                    return response()->json([
                        'message' => 'Lunas & Akun Berhasil Dikirim',
                        'order_id' => $order->id
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Gagal mengambil stok dari Catalog',
                        'detail' => $response->json()
                    ], 400);
                }

            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Koneksi ke Catalog gagal',
                    'error' => $e->getMessage()
                ], 500);
            }
        }

        return response()->json(['message' => 'Callback diterima, tapi status bukan success'], 200);
    }

    public function showInvoice($id)
    {
        $order = Order::with('details')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('invoice', compact('order'));
    }
}
