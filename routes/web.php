<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', [FrontController::class, 'shop'])->name('shop');
Route::get('/shop-item/{id}', [FrontController::class, 'shopItem'])->name('shop-item');
Route::get('item-categories/{category_id}', [FrontController::class, 'itemCategory'])->name('item.categories');
Route::get('item-carts', [FrontController::class, 'carts'])->name('item-carts.carts');
Route::post('order-now', [FrontController::class, 'orderNow'])->name('orderNow');

// Backend Routes
Route::group(['prefix' => 'backend', 'as' => 'backend.', 'middleware' => ['auth', 'role:Super Admin']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('items', ItemController::class);
    Route::get('orders', [OrderController::class, 'orders'])->name('orders');
    Route::get('orderAccept', [OrderController::class, 'orderAccept'])->name('orderAccept');
    Route::get('orderComplete', [OrderController::class, 'orderComplete'])->name('orderComplete');
    Route::get('orders/{voucher}', [OrderController::class, 'orderDetail'])->name('orders.detail');
    Route::put('orders/{voucher}', [OrderController::class, 'status'])->name('orders.status');
});

// Authentication Routes
Auth::routes();
