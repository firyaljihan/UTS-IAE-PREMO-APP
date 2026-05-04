<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AccountController;

Route::get('/products-list', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/get-stock', [AccountController::class, 'getStock']); 

Route::post('/admin/products', [ProductController::class, 'store']);
Route::post('/admin/accounts', [AccountController::class, 'store']);
