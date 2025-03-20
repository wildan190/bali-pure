<?php

use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\trackingController;
use App\Http\Controllers\WebController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/web/products', [WebController::class, 'products'])->name('web.products');
Route::get('/web/products/{id}/order', [WebController::class, 'showOrderForm'])->name('web.products.order');
Route::post('/web/products/order', [WebController::class, 'submitOrder'])->name('submitOrder');
Route::post('/midtrans/callback', [WebController::class, 'midtransCallback']);
Route::get('/order/{orderNumber}', [WebController::class, 'showOrderDetails'])->name('order.details');
Route::get('/order/{orderNumber}/receipt', [WebController::class, 'downloadReceipt'])->name('order.receipt');
Route::get('/tracking', [trackingController::class, 'index'])->name('tracking');
Route::post('/tracking/search', [TrackingController::class, 'search'])->name('tracking.search');

Route::middleware(['auth'])->group(function () {
  Route::redirect('settings', 'settings/profile');

  Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  Route::get('admin/settings/profile', Profile::class)->name('settings.profile');
  Route::get('admin/settings/password', Password::class)->name('settings.password');
  Route::get('admin/settings/appearance', Appearance::class)->name('settings.appearance');

  Route::get('admin/categories', [CategoryController::class, 'index'])->name('categories.index');
  Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('categories.create');
  Route::post('admin/categories', [CategoryController::class, 'store'])->name('categories.store');
  Route::get('admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
  Route::put('admin/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
  Route::delete('admin/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

  Route::get('admin/products', [ProductController::class, 'index'])->name('products.index');
  Route::get('admin/products/create', [ProductController::class, 'create'])->name('products.create');
  Route::post('admin/products', [ProductController::class, 'store'])->name('products.store');
  Route::get('admin/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
  Route::put('admin/products/{id}', [ProductController::class, 'update'])->name('products.update');
  Route::delete('admin/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

  Route::get('admin/galleries', [GalleryController::class, 'index'])->name('galleries.index');
  Route::get('admin/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
  Route::post('admin/galleries', [GalleryController::class, 'store'])->name('galleries.store');
  Route::get('admin/galleries/{id}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
  Route::put('admin/galleries/{id}', [GalleryController::class, 'update'])->name('galleries.update');
  Route::delete('admin/galleries/{id}', [GalleryController::class, 'destroy'])->name('galleries.destroy');

  Route::get('admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
  Route::post('admin/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});

require __DIR__ . '/auth.php';
