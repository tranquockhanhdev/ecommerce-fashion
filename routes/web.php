<?php

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
