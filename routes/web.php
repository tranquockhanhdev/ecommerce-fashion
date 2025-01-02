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

use App\Http\Controllers\ContactController;

Route::prefix('admin')->name('admin.')->group(function() {
    // Route cho danh sách liên hệ
    Route::get('qllienhe', [ContactController::class, 'index'])->name('qllienhe.index');

    // Route cho thêm, sửa, xóa liên hệ
    Route::get('qllienhe/create', [ContactController::class, 'create'])->name('qllienhe.create');
    Route::post('qllienhe', [ContactController::class, 'store'])->name('qllienhe.store');
    Route::get('qllienhe/{id}/edit', [ContactController::class, 'edit'])->name('qllienhe.edit');
    Route::put('qllienhe/{id}', [ContactController::class, 'update'])->name('qllienhe.update');
    Route::delete('qllienhe/{id}', [ContactController::class, 'destroy'])->name('qllienhe.destroy');
});

Route::get('/admin/qlbinhluan', function () {
    return view('admin.qlbinhluan.index');
})->name('admin.qlbinhluan.index');
