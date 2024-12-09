<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ItemController;

// Frontend Routes
Route::get('/', [FrontController::class, 'shop'])->name('shop');
Route::get('/shop-item/{id}', [FrontController::class, 'shopItem'])->name('shop-item');

// Backend Routes
Route::group(['prefix' => 'backend', 'as' => 'backend.'], function () {
    // Dashboard Route
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Items Resource Routes (automatically includes index, create, store, etc.)
    Route::resource('items', ItemController::class);
});

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
