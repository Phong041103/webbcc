<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\front\Homecontroller as FrontHomecontroller;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\VNPayController;
use App\Models\Order;

//frontend

Route::get('/', [FrontHomecontroller::class, 'index'])->name('trang-chu');
Route::get('danh-muc/{id}', [FrontHomecontroller::class, 'category'])->name('danh-muc');
Route::get('lien-he', [FrontHomecontroller::class, 'contact'])->name('lien-he');
Route::get('san-pham', [FrontHomecontroller::class, 'product'])->name('san-pham');
Route::get('gio-hang', [FrontHomecontroller::class, 'cart'])->name('gio-hang');

Auth::routes();
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/product/{id}', [FrontHomecontroller::class, 'detail'])->name('product.detail');

Route::post('/cart/add', [FrontHomecontroller::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [FrontHomecontroller::class, 'cart'])->name('cart.index');
Route::get('/cart/remove/{id}', [FrontHomecontroller::class, 'removeCart'])->name('cart.remove');
Route::post('/cart/update', [FrontHomecontroller::class, 'updateCart'])->name('cart.update');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

Route::get('/vnpay_payment/{id}', [VNPayController::class, 'vnpay_payment'])->name('vnpay_payment');
Route::get('/vnpay/return', [CheckoutController::class, 'vnpayReturn'])->name('vnpay.return');

Route::get('/bill/{id}', [CheckoutController::class, 'bill'])->name('bill');

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

Route::get('/home', function () {
    return view('layouts.app');
});

Route::post('/login-custom', [App\Http\Controllers\Auth\LoginController::class, 'login'])
    ->name('login.custom.post');

Route::get('/admin', function () {
    return view('admin.homea');
})->middleware(['auth', 'admin']);
