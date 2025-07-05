<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopOwnerRequestController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::get('/login', function () { return view('auth.login'); })->name('login.form');
Route::get('/register', function () { return view('auth.register'); })->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Shop owner request routes
    Route::post('/shop-owner-request', [ShopOwnerRequestController::class, 'store'])->name('shop-owner-request.store');

    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/shop-requests', [ShopOwnerRequestController::class, 'index'])->name('admin.shop-requests');
        Route::post('/admin/shop-requests/{id}/approve', [ShopOwnerRequestController::class, 'approve'])->name('admin.shop-requests.approve');
        Route::post('/admin/shop-requests/{id}/reject', [ShopOwnerRequestController::class, 'reject'])->name('admin.shop-requests.reject');
        Route::get('/admin/shops', [ShopController::class, 'adminIndex'])->name('admin.shops');
        Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('admin.products');
    });

    // Shop owner routes
    Route::middleware('shop_owner')->group(function () {
        Route::get('/shop/dashboard', [ShopController::class, 'dashboard'])->name('shop.dashboard');
        Route::get('/shop/create', [ShopController::class, 'create'])->name('shop.create');
        Route::post('/shop', [ShopController::class, 'store'])->name('shop.store');
        Route::get('/shop/{id}/edit', [ShopController::class, 'edit'])->name('shop.edit');
        Route::put('/shop/{id}', [ShopController::class, 'update'])->name('shop.update');

        // Product routes
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
});

// Public routes
Route::get('/explore', [ProductController::class, 'explore'])->name('products.explore');
Route::get('/shops', [ShopController::class, 'publicIndex'])->name('shops.index');
Route::get('/shop/{id}', [ShopController::class, 'show'])->name('shop.show');
