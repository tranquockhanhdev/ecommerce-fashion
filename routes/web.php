<?php

use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
        Route::resource('admin', AdminController::class);

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
    Route::get('/secretkey', [App\Http\Controllers\Auth\SecretController::class, 'showSecret'])->name('secretkey');
    Route::get('/checkout', function () {
        return view('client.checkout');
    })->name('client.checkout');
    Route::get('/wishlist', function () {
        return view('client.wishlist');
    })->name('client.wishlist');
    Route::get('/shopping-cart', function () {
        return view('client.shopping-cart');
    })->name('client.shopping-cart');
    Route::get('/account-setting', function () {
        return view('client.account-setting');
    })->name('client.account-setting');
    Route::get('/order-details', function () {
        return view('client.order-details');
    })->name('client.order-details');
    Route::get('/user-dashboard', function () {
        return view('client.user-dashboard');
    })->name('client.user-dashboard');
    Route::get('/order-history', function () {
        return view('client.order-history');
    })->name('client.order-history');
});
// Các route khác không cần đăng nhập
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
Route::get('/', function () {
    return view('client.homepage');
})->name('client.homepage');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
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
Route::get('/product-details', function () {
    return view('client.product-details');
})->name('client.product-details');
