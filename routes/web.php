<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('client.homepage');
});

Route::get('/admin', function () {
    return view('admin.home.index');
})->name('admin.home.index');

Route::get('/admin/qldonhang', function () {
    return view('admin.qldonhang.index');
})->name('admin.qldonhang.index');

Route::get('/admin/qlkhachhang', function () {
    return view('admin.qlkhachhang.index');
})->name('admin.qlkhachhang.index');

Route::get('/admin/qlnhanvien', function () {
    return view('admin.qlnhanvien.index');
})->name('admin.qlnhanvien.index');

Route::get('/admin/qlsanpham', function () {
    return view('admin.qlsanpham.index');
})->name('admin.qlsanpham.index');

Route::get('/admin/qldanhmuc', function () {
    return view('admin.qldanhmuc.index');
})->name('admin.qldanhmuc.index');

Route::get('/admin/qllienhe', function () {
    return view('admin.qllienhe.index');
})->name('admin.qllienhe.index');

Route::get('/admin/qlbinhluan', function () {
    return view('admin.qlbinhluan.index');
})->name('admin.qlbinhluan.index');
Route::get('/signup', function () {
    return view('client.sign-up');
})->name('client.sign-up');
Route::get('/home', function () {
    return view('client.homepage');
})->name('client.homepage');
Route::get('/shop', function () {
    return view('client.shop');
})->name('client.shop');
Route::get('/blog-list', function () {
    return view('client.blog-list');
})->name('client.blog-list');
Route::get('/single-blog', function () {
    return view('client.single-blog');
})->name('client.single-blog');
Route::get('/about', function () {
    return view('client.about');
})->name('client.about');
Route::get('/contact', function () {
    return view('client.contact');
})->name('client.contact');
Route::get('/user-dashboard', function () {
    return view('client.user-dashboard');
})->name('client.user-dashboard');
Route::get('/order-history', function () {
    return view('client.order-history');
})->name('client.order-history');
Route::get('/wishlist', function () {
    return view('client.wishlist');
})->name('client.wishlist');
Route::get('/shopping-cart', function () {
    return view('client.shopping-cart');
})->name('client.shopping-cart');
Route::get('/account-setting', function () {
    return view('client.account-setting');
})->name('client.account-setting');
Route::get('/product-details', function () {
    return view('client.product-details');
})->name('client.product-details');
Route::get('/order-details', function () {
    return view('client.order-details');
})->name('client.order-details');
Route::get('/checkout', function () {
    return view('client.checkout');
})->name('client.checkout');



Route::get('/admin/qlsanpham', [ProductController::class, 'index'])->name('admin.qlsanpham.index');
// Resource routes cho Product
Route::resource('products', ProductController::class);

