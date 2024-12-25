<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PaymentController;



Route::get('/', [FrontController::class, 'shop'])->name('shop');
Route::get('/shop-item/{id}', [FrontController::class, 'shopItem'])->name('shop-item');


Route::get('item-carts',[App\Http\Controllers\FrontController::class, 'carts'])->name('item-carts.carts');

Route::post('order-now',[App\Http\Controllers\FrontController::class, 'orderNow'])->name('orderNow');

Route::group(['middleware'=>['auth','role:Super Admin|Admin'],'prefix' => 'backend', 'as' => 'backend.'], function () {
   
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    
    Route::resource('items', ItemController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('payments', PaymentController::class);

Route::get('orders',[App\Http\Controllers\Admin\OrderController::class, 'orders'])->name('orders');
Route::get('orderAccept',[App\Http\Controllers\Admin\OrderController::class, 'orderAccept'])->name('orderAccept');
Route::get('orderComplete',[App\Http\Controllers\Admin\OrderController::class, 'orderComplete'])->name('orderComplete');
Route::get('orders/{voucher}', [App\Http\Controllers\Admin\OrderController::class, 'orderDetail'])->name('orders.detail');
Route::put('orders/{voucher}', [App\Http\Controllers\Admin\OrderController::class, 'status'])->name('orders.status');
});

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
