<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.client');
});

Route::get('/admin', function () {
    return view('admin.home.index');
})->name('admin.home.index');

use App\Http\Controllers\OrderController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('qldonhang', OrderController::class);
});

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

use App\Http\Controllers\ContactController;

Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('qllienhe', ContactController::class);
});

Route::get('/admin/qlbinhluan', function () {
    return view('admin.qlbinhluan.index');
})->name('admin.qlbinhluan.index');
