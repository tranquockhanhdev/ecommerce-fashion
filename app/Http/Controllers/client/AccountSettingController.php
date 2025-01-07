<?php

namespace App\Http\Controllers\client;

use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountSettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;
        $website = Account::findOrFail($userId);
        return view('client.user.account-setting', compact('website'));
    }
    public function changePassword(Request $request)
    {
        // Xác thực dữ liệu nhập vào
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
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
        ], [
            'current_password.required' => 'Mật khẩu hiện tại là bắt buộc.',
            'password.required' => 'Mật khẩu mới là bắt buộc.',
            'password.string' => 'Mật khẩu mới phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'password.max' => 'Mật khẩu mới không được vượt quá 30 ký tự.',
            'password.regex' => 'Mật khẩu mới phải chứa ít nhất một chữ cái hoa, một chữ cái thường, một số và một ký tự đặc biệt.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp với mật khẩu mới.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        // Cập nhật mật khẩu mới
        $user = Account::where('id', Auth::user()->id)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('client.user.account-setting')->with('success', 'Mật khẩu đã được thay đổi.');
    }
    public function changeInfo(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|numeric',
        ]);
        $website = Account::find(Auth::user()->id);
        $website->address = $request->input('address');
        $website->phone = $request->input('phone');
        $website->save();

        // Quay lại trang trước đó với thông báo thành công
        return redirect()->back()->with('successs', 'Thông tin đã được cập nhật!');
    }
}
