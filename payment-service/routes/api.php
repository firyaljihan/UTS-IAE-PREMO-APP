<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PaymentController;

Route::post('/qris', [PaymentController::class, 'store']);
Route::apiResource('payment', PaymentController::class);
Route::post('/confirm-payment', [PaymentController::class, 'confirm']);
