<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Shop Routes (Customer facing) - PUBLIC
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/products/{product}', [ShopController::class, 'show'])->name('shop.show');

// Cart Routes - PROTECTED (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{productId}', [ShopController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove/{id}', [ShopController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/update/{id}', [ShopController::class, 'updateCart'])->name('cart.update');
});

// Cart page can be viewed by anyone (but shows login prompt for guests)
Route::get('/cart', [ShopController::class, 'cart'])->name('cart');

// Breeze Authentication Routes (keep these as they are)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Admin Routes - Protected by auth
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::resource('products', ProductController::class);
});

// Laravel Breeze Auth Routes (DO NOT MODIFY)
require __DIR__.'/auth.php';