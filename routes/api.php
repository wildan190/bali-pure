<?php

use App\Http\Controllers\Api\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');

Route::prefix('web')->group(function () {
  Route::get('/index', [WebController::class, 'index']); // Produk unggulan & gallery
  Route::get('/products', [WebController::class, 'products']); // Semua produk (dengan pencarian)
  Route::get('/order/{id}', [WebController::class, 'showOrderForm']); // Ambil detail produk sebelum order
  Route::post('/order/submit', [WebController::class, 'submitOrder']); // Buat order baru
  Route::get('/order/{order_number}', [WebController::class, 'showOrderDetails']); // Ambil detail order
  Route::get('/order/{order_number}/receipt', [WebController::class, 'downloadReceipt']); // Dapatkan link struk pembelian
});
