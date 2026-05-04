<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::post('/checkout', [OrderController::class, 'checkout'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {
    // Route::post('/checkout', [OrderController::class, 'checkout']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/payment-callback', [OrderController::class, 'paymentCallback']);

