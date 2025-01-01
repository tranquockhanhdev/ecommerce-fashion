<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('layouts.app');
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
    return view('client.auth.sign-up');
})->name('client.sign-up');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
