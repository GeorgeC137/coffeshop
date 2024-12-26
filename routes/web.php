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
Route::get('products/checkout', [ProductController::class, 'checkout'])->name('checkout')->middleware('check.for.price');
Route::post('products/checkout', [ProductController::class, 'processCheckout'])->name('process.checkout')->middleware('check.for.price');

// pay & success
Route::get('products/pay', [ProductController::class, 'payWithPaypal'])->name('products.pay')->middleware('check.for.price');
Route::get('products/success', [ProductController::class, 'success'])->name('products.pay.success')->middleware('check.for.price');

// Bookings
Route::post('products/bookings', [ProductController::class, 'bookTable'])->name('bookings');

// Menu
Route::get('products/menu', [ProductController::class, 'menu'])->name('products.menu');
