<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\client\AccountController;
use App\Http\Controllers\client\AccountSettingController;
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

    // User routes
    Route::prefix('user')->group(function () {
        Route::prefix('account-setting')->name('client.user.account-setting')->group(function () {
            Route::get('/', [AccountSettingController::class, 'index']);
            Route::post('/', [AccountSettingController::class, 'changePassword']);
        });

        Route::get('/dashboard', function () {
            return view('client.user.user-dashboard');
        })->name('client.user.user-dashboard');

        Route::get('/order-details', function () {
            return view('client.user.order-details');
        })->name('client.user.order-details');

        Route::get('/order-history', function () {
            return view('client.user.order-history');
        })->name('client.user.order-history');
    });

    // Cart routes
    Route::prefix('cart')->group(function () {
        Route::get('/checkout', function () {
            return view('client.cart.checkout');
        })->name('client.cart.checkout');

        Route::get('/wishlist', function () {
            return view('client.cart.wishlist');
        })->name('client.cart.wishlist');

        Route::get('/shopping-cart', function () {
            return view('client.cart.shopping-cart');
        })->name('client.cart.shopping-cart');
    });

    // Secret route
    Route::get('/secretkey', [App\Http\Controllers\Auth\SecretController::class, 'showSecret'])->name('secretkey');
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
// Public routes
Route::get('/', function () {
    return view('client.pages.homepage');
})->name('client.pages.homepage');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('shop')->group(function () {
    Route::get('/shop', function () {
        return view('client.shop.shop');
    })->name('client.shop.shop');

    Route::get('/product-details', function () {
        return view('client.shop.product-details');
    })->name('client.shop.product-details');
});

// Blog routes
Route::prefix('blog')->group(function () {
    Route::get('/list', function () {
        return view('client.blog.blog-list');
    })->name('client.blog.blog-list');

    Route::get('/single', function () {
        return view('client.blog.single-blog');
    })->name('client.blog.single-blog');
});

// Static pages
Route::prefix('pages')->group(function () {
    Route::get('/about', function () {
        return view('client.pages.about');
    })->name('client.pages.about');

    Route::get('/contact', function () {
        return view('client.pages.contact');
    })->name('client.pages.contact');
});
