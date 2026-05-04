<?php

use Illuminate\Support\Facades\Route;
use App\Models\Transaction;


Route::get('/admin-payment', function () {
   
    $transactions = Transaction::orderBy('created_at', 'desc')->get();
    return view('admin_payment', compact('transactions'));
});
