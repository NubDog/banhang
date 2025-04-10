<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

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


// Admin routes
// Xóa các route này
// Route::get('/admin/dang-nhap', [UserController::class, 'getAdminLogin'])->name('admin.getLogin');
// Route::post('/admin/dang-nhap', [UserController::class, 'postAdminLogin'])->name('admin.postLogin');

// Giữ lại route group cho admin
// Thay đổi cách khai báo middleware
Route::middleware(['admin'])->prefix('admin')->group(function() {
    Route::get('/dashboard', function() {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Nhóm route cho admin - thêm lại middleware auth trước
// Nhóm route cho admin - thêm cả hai middleware
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function() {
    // Update the dashboard route in the admin group
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
    
    // Category routes
    // admin/category/danhsach
    Route::get('danhsach', [CategoryController::class, 'getCateList'])->name('admin.getCateList');
    Route::get('them', [CategoryController::class, 'getCateAdd'])->name('admin.getCateAdd');
    Route::post('them', [CategoryController::class, 'postCateAdd'])->name('admin.postCateAdd');
    Route::get('xoa/{id}', [CategoryController::class, 'getCateDelete'])->name('admin.getCateDelete');
    Route::get('sua/{id}', [CategoryController::class, 'getCateEdit'])->name('admin.getCateEdit');
    Route::post('sua/{id}', [CategoryController::class, 'postCateEdit'])->name('admin.postCateEdit');
});

// Admin routes - không sử dụng middleware
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Nhóm route cho admin - sử dụng middleware admin
Route::prefix('admin')->middleware('admin')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Category routes
    Route::prefix('category')->group(function() {
        Route::get('danhsach', [CategoryController::class, 'getCateList'])->name('admin.getCateList');
        Route::get('them', [CategoryController::class, 'getCateAdd'])->name('admin.getCateAdd');
        Route::post('them', [CategoryController::class, 'postCateAdd'])->name('admin.postCateAdd');
        Route::get('xoa/{id}', [CategoryController::class, 'getCateDelete'])->name('admin.getCateDelete');
        Route::get('sua/{id}', [CategoryController::class, 'getCateEdit'])->name('admin.getCateEdit');
        Route::post('sua/{id}', [CategoryController::class, 'postCateEdit'])->name('admin.postCateEdit');
    });
    
    // Product routes
    Route::prefix('product')->group(function() {
        Route::get('/', [AdminProductController::class, 'index'])->name('admin.product.index');
        Route::get('/create', [AdminProductController::class, 'create'])->name('admin.product.create');
        Route::post('/', [AdminProductController::class, 'store'])->name('admin.product.store');
        Route::get('/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('/{id}', [AdminProductController::class, 'update'])->name('admin.product.update');
        Route::get('/{id}/delete', [AdminProductController::class, 'destroy'])->name('admin.product.delete');
    });
    
    // User routes
    Route::prefix('user')->group(function() {
        Route::get('/', [AdminUserController::class, 'index'])->name('admin.user.index');
        Route::get('/create', [AdminUserController::class, 'create'])->name('admin.user.create');
        Route::post('/', [AdminUserController::class, 'store'])->name('admin.user.store');
        Route::get('/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
        Route::get('/{id}/delete', [AdminUserController::class, 'destroy'])->name('admin.user.delete');
    });
    
    // Order routes
    Route::prefix('order')->group(function() {
        Route::get('/', [AdminOrderController::class, 'index'])->name('admin.order.index');
        Route::get('/{id}', [AdminOrderController::class, 'show'])->name('admin.order.detail');
        Route::post('/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.order.update-status');
    });
});
