<?php

namespace App\Http\Controllers\client;

use Illuminate\Support\Facades\Storage;
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
    public function changeAddress(Request $request)
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
    public function changeInfo(Request $request)
    {
        $userId = Auth::user()->id; // Lấy ID người dùng hiện tại
        $website = Account::find($userId);

        // Kiểm tra nếu email thay đổi
        $emailRules = $website->email === $request->input('email')
            ? 'required|string|email|max:255'
            : 'required|string|email|max:255|unique:account';

        // Xác thực dữ liệu
        $request->validate([
            'lastname' => 'required|string|max:255', // Họ
            'firstname' => 'required|string|max:255', // Tên
            'email' => $emailRules,
            'date' => 'required|date',
        ], [
            'lastname.required' => 'Họ là bắt buộc.',
            'lastname.string' => 'Họ phải là chuỗi ký tự.',
            'lastname.max' => 'Họ không được vượt quá 255 ký tự.',
            'firstname.required' => 'Tên là bắt buộc.',
            'firstname.string' => 'Tên phải là chuỗi ký tự.',
            'firstname.max' => 'Tên không được vượt quá 255 ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.string' => 'Email phải là chuỗi ký tự.',
            'email.email' => 'Email phải là địa chỉ email hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email này đã tồn tại trong hệ thống.',
            'date.required' => 'Ngày là bắt buộc.',
            'date.date' => 'Ngày phải là định dạng ngày hợp lệ.',
        ]);

        // Cập nhật thông tin người dùng
        $website->firstname = $request->input('firstname');
        $website->lastname = $request->input('lastname');
        $website->email = $request->input('email');
        $website->date = $request->input('date');
        $website->save();

        return redirect()->back()->with('successinfo', 'Thông tin đã được cập nhật!');
    }

    public function changeAvatar(Request $request)
    {
        // Xác thực tệp tải lên
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:5000', // Tối đa 5MB
        ], [
            'logo.image' => 'Logo phải là một tệp hình ảnh.',
            'logo.mimes' => 'Logo chỉ được chấp nhận định dạng .png, .jpg, .jpeg.',
            'logo.max' => 'Logo không được vượt quá 5MB.',
        ]);

        // Lấy thông tin tài khoản người dùng
        $account = Account::find(Auth::user()->id);

        if ($request->hasFile('logo')) {
            // Lưu tệp logo mới
            $fileName = time() . '_' . uniqid() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->storeAs('logos', $fileName, 'public');

            // Cập nhật thông tin logo mới trong cơ sở dữ liệu
            $account->image = $fileName;
        }

        // Lưu thay đổi
        $account->save();

        return redirect()->back()->with('successinfo', 'Thông tin đã được cập nhật!');
    }
}
