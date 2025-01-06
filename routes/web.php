<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Authentication routes
Auth::routes([
    'reset' => false,     // Disable password reset
    'verify' => false,    // Disable email verification
    'confirm' => false    // Disable email confirmation
]);

// Fallback for undefined routes
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// Routes that require authentication
Route::middleware(['auth'])->group(function () {

    // Admin routes
    Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {
        Route::view('/', 'admin.home.index')->name('home.index');
        Route::view('/qldonhang', 'admin.qldonhang.index')->name('qldonhang.index');
        Route::view('/qlkhachhang', 'admin.qlkhachhang.index')->name('qlkhachhang.index');
        Route::view('/qlnhanvien', 'admin.qlnhanvien.index')->name('qlnhanvien.index');
        Route::view('/qlsanpham', 'admin.qlsanpham.index')->name('qlsanpham.index');
        Route::view('/qldanhmuc', 'admin.qldanhmuc.index')->name('qldanhmuc.index');
        Route::view('/qllienhe', 'admin.qllienhe.index')->name('qllienhe.index');
        Route::view('/qlbinhluan', 'admin.qlbinhluan.index')->name('qlbinhluan.index');

        // Resource routes
        Route::resource('products', ProductController::class);
        Route::resource('qldonhang', OrderController::class);
        Route::resource('qllienhe', ContactController::class);
        Route::resource('colors', ColorController::class);
        Route::resource('sizes', SizeController::class);

        // Additional admin routes
        Route::delete('/delete-image/{imageId}', [ProductController::class, 'deleteImage'])->name('deleteImage');
        Route::post('/products/{id}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggleStatus');
    });

    // Staff routes (admin and staff roles)
    Route::prefix('staff')->middleware('role:admin,staff')->name('staff.')->group(function () {
        Route::view('/', 'staff.home.index')->name('home.index');
    });

    // User-specific routes
    Route::prefix('client')->name('client.')->group(function () {
        Route::view('/checkout', 'client.checkout')->name('checkout');
        Route::view('/wishlist', 'client.wishlist')->name('wishlist');
        Route::view('/shopping-cart', 'client.shopping-cart')->name('shopping-cart');
        Route::view('/account-setting', 'client.account-setting')->name('account-setting');
        Route::view('/order-details', 'client.order-details')->name('order-details');
        Route::view('/user-dashboard', 'client.user-dashboard')->name('user-dashboard');
        Route::view('/order-history', 'client.order-history')->name('order-history');
    });

    // Secret key route
    Route::get('/secretkey', [App\Http\Controllers\SecretController::class, 'showSecret'])->name('secretkey');
});

// Public routes
Route::prefix('client')->name('client.')->group(function () {
    Route::view('/', 'client.homepage')->name('homepage');
    Route::view('/shop', 'client.shop')->name('shop');
    Route::view('/blog-list', 'client.blog-list')->name('blog-list');
    Route::view('/single-blog', 'client.single-blog')->name('single-blog');
    Route::view('/about', 'client.about')->name('about');
    Route::view('/contact', 'client.contact')->name('contact');
    Route::view('/product-details', 'client.product-details')->name('product-details');
});

// Forgot password routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/forgotpassword', [ForgotPasswordController::class, 'nhapEmail'])->name('forgotpassword');
    Route::post('/forgotpassword', [ResetPasswordController::class, 'checkInfo'])->name('checkInfo');
    Route::get('/confirmpassword', [ConfirmPasswordController::class, 'confirmPassword'])->name('confirmpassword');
    Route::post('/confirmpassword', [ResetPasswordController::class, 'updatePassword'])->name('updatePassword');
});

// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
