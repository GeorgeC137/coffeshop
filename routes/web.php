<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// products
Route::get('products/product-single/{id}', [ProductController::class, 'singleProduct'])->name('single.product');
Route::post('products/cart/{id}', [ProductController::class, 'addToCart'])->name('add.cart');
Route::get('products/cart', [ProductController::class, 'cart'])->name('cart');
Route::get('products/cart-delete/{id}', [ProductController::class, 'deleteFromCart'])->name('delete.cart');

// checkout
Route::post('products/prepare-checkout', [ProductController::class, 'prepareCheckout'])->name('prepare.checkout');
Route::get('products/checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::post('products/checkout', [ProductController::class, 'processCheckout'])->name('process.checkout');
