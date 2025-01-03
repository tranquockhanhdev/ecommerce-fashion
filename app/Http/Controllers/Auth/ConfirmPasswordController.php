<?php

namespace App\Http\Controllers\Auth;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    public function confirmPassword(Request $request)
    {
        $email = $request->query('email');
        $secret_id = $request->query('secret_id');

        // Kiểm tra nếu email và secret_id có tồn tại trong yêu cầu
        if ($email && $secret_id) {
            // Kiểm tra nếu tài khoản tồn tại với email và secret_id đúng
            $account = Account::where('email', $email)->first();

            if ($account && $account->secret_id == $secret_id) {
                return view('auth.passwords.confirm', ['email' => $email, 'secret_id' => $secret_id]);
            } else {
                return redirect()->route('auth.forgotpassword')->withErrors(['error' => 'Thông tin xác thực không hợp lệ.']);
            }
        } else {
            return redirect()->route('auth.forgotpassword')->withErrors(['error' => 'Thiếu thông tin cần thiết.']);
        }
    }
}
