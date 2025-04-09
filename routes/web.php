<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Trang giới thiệu
Route::get('/gioi-thieu', [HomeController::class, 'getAbout'])->name('gioithieu');

// Trang liên hệ
Route::get('/lien-he', [HomeController::class, 'getContact'])->name('lienhe');

// Tìm kiếm sản phẩm
Route::get('/search', [HomeController::class, 'getSearch'])->name('search');

// Đăng ký và đăng nhập
Route::get('/dang-ky', [UserController::class, 'getRegister'])->name('register');
Route::post('/dang-ky', [UserController::class, 'postRegister']);
Route::get('/dang-nhap', [UserController::class, 'getLogin'])->name('login');
Route::post('/dang-nhap', [UserController::class, 'postLogin']);
Route::get('/dang-xuat', [UserController::class, 'getLogout'])->name('logout');

// Sản phẩm
Route::get('/san-pham/{id}', [ProductController::class, 'getProductDetail'])->name('product.detail');
Route::get('/loai-san-pham/{type_id}', [ProductController::class, 'getProductsByType'])->name('loaisanpham');

// Giỏ hàng
// Route cho giỏ hàng
// Giỏ hàng và đặt hàng
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('reduce-by-one/{id}', [CartController::class, 'reduceByOne'])->name('reduce-by-one'); // Add this line
Route::get('remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove-from-cart');
Route::get('cart', [CartController::class, 'showCart'])->name('cart');
Route::get('dat-hang', [CartController::class, 'getCheckout'])->name('dathang');
Route::post('dat-hang', [CartController::class, 'postCheckout'])->name('dathang');

// Temporary route to check users table structure
Route::get('/check-users-table', [UserController::class, 'checkUsersTable']);

// Thêm route cho form quên mật khẩu
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
    ->name('password.email');
