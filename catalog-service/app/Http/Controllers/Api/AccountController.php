<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function getStock(Request $request)
{
    $request->validate([
        'product_id' => 'required',
        'qty' => 'required|integer|min:1'
    ]);

    return DB::transaction(function () use ($request) {
        $accounts = Account::where('product_id', $request->product_id)
                           ->where('status', 'READY')
                           ->limit($request->qty)
                           ->lockForUpdate()
                           ->get();

        if ($accounts->count() < $request->qty) {
            return response()->json(['message' => 'Stok akun habis!'], 400);
        }

        $dataToSend = $accounts->toArray();

        foreach ($accounts as $acc) {
            $acc->update(['status' => 'SOLD']);
        }

        // KIRIM DATA YANG SUDAH DIUBAH JADI ARRAY
        return response()->json($dataToSend);
    });
}

    public function store(Request $request)
    {
        foreach ($request->accounts as $acc) {
            Account::create([
                'product_id' => $request->product_id,
                'email_premium' => $acc['email'],
                'password_premium' => $acc['password'],
                'profile_name' => $acc['profile_name'],
                'pin' => $acc['pin'] ?? null,
                'status' => 'READY'
            ]);
        }
        return response()->json(['message' => 'Stok berhasil diupdate']);
    }
}
