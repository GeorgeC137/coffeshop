<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Admins\AdminsController;
use App\Http\Controllers\Product\ProductController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [App\Http\Controllers\HomeController::class, 'submitContact'])->name('post.contact')->middleware('auth');

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
    Route::post('/bookings', [ProductController::class, 'bookTable'])->name('booking.table')->middleware('auth:web');

    // menu
    Route::get('/menu', [ProductController::class, 'menu'])->name('products.menu');
});

Route::group(['prefix' => 'users', 'middleware' => 'auth:web'], function() {
    // users pages
    Route::get('/orders', [UsersController::class, 'displayOrders'])->name('users.orders');
    Route::get('/bookings', [UsersController::class, 'displayBookings'])->name('users.bookings');
    Route::get('/reviews', [UsersController::class, 'writeReview'])->name('reviews');
    Route::post('/reviews', [UsersController::class, 'postReview'])->name('post.review');
});

Route::get('/admin/login', [AdminsController::class, 'loginPage'])->name('view.login')->middleware('check.for.auth');
Route::post('/admin/login', [AdminsController::class, 'loginAdmin'])->name('login.admin');
Route::post('/admin/logout', [AdminsController::class, 'logoutAdmin'])->name('logout.admin')->middleware('auth:admin');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::get('/index', [AdminsController::class, 'index'])->name('admins.dashboard');
    Route::get('/all-admins', [AdminsController::class, 'displayAdmins'])->name('all.admins');
    Route::get('/create-admin', [AdminsController::class, 'createAdmin'])->name('create.admin');
    Route::post('/create-admin', [AdminsController::class, 'storeAdmin'])->name('store.admin');
    Route::delete('/delete-admin/{id}', [AdminsController::class, 'deleteAdmin'])->name('delete.admin');

    // orders
    Route::get('/all-orders', [AdminsController::class, 'displayOrders'])->name('all.orders');
    Route::get('/edit-order/{id}', [AdminsController::class, 'displayOrder'])->name('edit.order');
    Route::post('/edit-order/{id}', [AdminsController::class, 'updateOrder'])->name('update.order');
    Route::delete('/delete-order/{id}', [AdminsController::class, 'deleteOrder'])->name('delete.order');

    // products
    Route::get('/all-products', [AdminsController::class, 'displayProducts'])->name('all.products');
    Route::get('/create-product', [AdminsController::class, 'createProduct'])->name('create.product');
    Route::post('/create-product', [AdminsController::class, 'storeProduct'])->name('store.product');
    Route::delete('/delete-product/{id}', [AdminsController::class, 'deleteProduct'])->name('delete.product');

    // bookings
    Route::get('/all-bookings', [AdminsController::class, 'displayBookings'])->name('all.bookings');
    Route::get('/edit-booking/{id}', [AdminsController::class, 'displayBooking'])->name('edit.booking');
    Route::post('/edit-booking/{id}', [AdminsController::class, 'updateBooking'])->name('update.booking');
    Route::delete('/delete-booking/{id}', [AdminsController::class, 'deleteBooking'])->name('delete.booking');
    });

// tests
Route::get('/test-guard', function () {
    if (Auth::guard('admin')->check()) {
        return 'Admin is logged in!';
    }
    return 'Admin is not logged in!';
});

Route::middleware('auth:admin')->get('/admin-test', function () {
    return 'Admin middleware is working!';
});


