<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;

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
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('/xoa-gio-hang/{id}', [CartController::class, 'removeFromCart'])->name('xoagiohang');
Route::get('/dat-hang', [CartController::class, 'getCheckout'])->name('dathang');
Route::post('/dat-hang', [CartController::class, 'postCheckout'])->name('dathang');
