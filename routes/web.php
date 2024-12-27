<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Users\UsersController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

Route::group(['prefix' => 'products'], function() {
    // products
    Route::get('/product-single/{id}', [ProductController::class, 'singleProduct'])->name('single.product');
    Route::post('/cart/{id}', [ProductController::class, 'addToCart'])->name('add.cart')->middleware('auth:web');
    Route::get('/cart', [ProductController::class, 'cart'])->name('cart')->middleware('auth:web');
    Route::get('/cart-delete/{id}', [ProductController::class, 'deleteFromCart'])->name('delete.cart')->middleware('auth:web');

    // checkout
    Route::post('/prepare-checkout', [ProductController::class, 'prepareCheckout'])->name('prepare.checkout');
    Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout')->middleware('check.for.price');
    Route::post('/checkout', [ProductController::class, 'processCheckout'])->name('process.checkout')->middleware('check.for.price');

    // pay & success
    Route::get('/pay', [ProductController::class, 'payWithPaypal'])->name('products.pay')->middleware('check.for.price');
    Route::get('/success', [ProductController::class, 'success'])->name('products.pay.success')->middleware('check.for.price');

    // bookings
    Route::post('/bookings', [ProductController::class, 'bookTable'])->name('bookings');

    // menu
    Route::get('/menu', [ProductController::class, 'menu'])->name('products.menu');
});

Route::group(['prefix' => 'users'], function() {
    // users pages
    Route::get('/orders', [UsersController::class, 'displayOrders'])->name('users.orders')->middleware('auth:web');
    Route::get('/bookings', [UsersController::class, 'displayBookings'])->name('users.bookings')->middleware('auth:web');
    Route::get('/reviews', [UsersController::class, 'writeReview'])->name('reviews')->middleware('auth:web');
    Route::post('/reviews', [UsersController::class, 'postReview'])->name('post.review')->middleware('auth:web');
});

