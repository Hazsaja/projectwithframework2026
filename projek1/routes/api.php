<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Jika menggunakan controller biasa:
Route::get('/products', [ProductController::class, 'index']);

// ATAU jika menggunakan Resource Controller:
Route::apiResource('products', ProductController::class);