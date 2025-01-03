<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\SecretController;

Auth::routes([
    'reset' => false,     // Tắt route reset mật khẩu
    'verify' => false,     // Tắt route xác minh email
    'confirm' => false     // Tắt route xác minh email
]);
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
Route::middleware(['auth'])->group(function () {
    // Trang quản trị chỉ dành cho admin
    Route::middleware(['role:admin'])->group(function () {
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
    });

    // Trang nhân viên chỉ dành cho nhân viên và admin
    Route::middleware(['role:admin,staff'])->group(function () {
        Route::get('/staff', function () {
            return view('staff.home.index');
        })->name('staff.home.index');
    });

    // Các route khác dành cho người đăng nhập
    Route::get('/secretkey', [App\Http\Controllers\SecretController::class, 'showSecret'])->name('secretkey');
});
// Các route khác không cần đăng nhập
Route::get('/', function () {
    return view('layouts.app');
});

Route::prefix('auth')->name('auth.')->group(function () {
    // Route để nhập email (GET)
    Route::get('/forgotpassword', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'nhapEmail'])->name('forgotpassword');
    // Route để kiểm tra email va secret (POST)
    Route::post('/forgotpassword', [App\Http\Controllers\Auth\ResetPasswordController::class, 'checkInfo'])->name('checkInfo');
    // Route hiển thị form xác nhận mật khẩu (GET)
    Route::get('/confirmpassword', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirmPassword'])->name('confirmpassword');
    // Route xử lý việc thay đổi mật khẩu (POST)
    Route::post('/confirmpassword', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePassword'])->name('updatePassword');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
