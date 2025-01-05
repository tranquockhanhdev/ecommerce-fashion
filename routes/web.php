<?php

use App\Http\Controllers\BinhluanController;
use App\Http\Controllers\DanhmucController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.client');
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

Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('qldanhmuc', DanhmucController::class);
});

Route::get('/admin/qllienhe', function () {
    return view('admin.qllienhe.index');
})->name('admin.qllienhe.index');

Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('qlbinhluan', BinhluanController::class);
});