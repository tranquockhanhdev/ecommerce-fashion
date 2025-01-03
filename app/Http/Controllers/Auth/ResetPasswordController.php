<?php

namespace App\Http\Controllers\Auth;

use App\Models\Account;
use App\Models\Secret;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    public function checkInfo(Request $request)
    {
        // Lấy thông tin email và mã bí mật từ người dùng
        $email = $request->input('email');
        $key = $request->input('content');

        // Tìm tài khoản có email tương ứng
        $account = Account::where('email', $email)->first();

        // Kiểm tra nếu tài khoản tồn tại
        if ($account) {
            // Kiểm tra mã bí mật có khớp với tài khoản này không
            $secret = Secret::where('id', $account->secret_id)
                ->where('content', $key)
                ->first();

            // Nếu mã bí mật hợp lệ
            if ($secret) {
                return redirect()->route('auth.confirmpassword', ['email' => $email, 'secret_id' => $account->secret_id]);
            } else {
                // Nếu mã bí mật không hợp lệ
                return back()->withErrors(['content' => 'Mã bí mật không chính xác.']);
            }
        } else {
            // Nếu email không tồn tại trong hệ thống
            return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.']);
        }
    }
    public function updatePassword(Request $request)
    {
        // Kiểm tra tính hợp lệ của mật khẩu
        $validated = $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'max:30',
                'regex:/[a-z]/', // Ít nhất 1 chữ cái thường
                'regex:/[A-Z]/', // Ít nhất 1 chữ cái hoa
                'regex:/[0-9]/', // Ít nhất 1 số
                'regex:/[@$!%*?&#]/', // Ít nhất 1 ký tự đặc biệt
                'confirmed', // Kiểm tra khớp với trường xác nhận mật khẩu
            ],
            'email' => 'required|email',
            'secret_id' => 'required',
        ]);

        $account = Account::where('email', $request->email)->first();

        if ($account && $account->secret_id == $request->secret_id) {
            // Cập nhật mật khẩu
            $account->password = Hash::make($request->password);
            $account->save();

            // Thông báo thành công và chuyển hướng
            Auth::login($account);
            return redirect()->route('home')->with('status', 'Mật khẩu của bạn đã được thay đổi thành công.');
        }

        return back()->withErrors(['error' => 'Thông tin không hợp lệ.']);
    }
}
