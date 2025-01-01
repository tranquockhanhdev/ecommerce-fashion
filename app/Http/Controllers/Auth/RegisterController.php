<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Secret;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';  // Điều hướng sau khi đăng ký thành công

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function generateRandomContext()
    {
        $context = '';
        for ($i = 0; $i < 5; $i++) {
            $context .= $this->generateRandomPart();
            if ($i < 4) {
                $context .= '-';  // Thêm dấu gạch ngang sau mỗi phần, ngoại trừ phần cuối
            }
        }
        return $context;
    }
    public function generateRandomPart()
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';  // Các ký tự chữ cái
        $numbers = '0123456789';  // Các chữ số

        // Lấy 1 ký tự chữ ngẫu nhiên
        $letter = $letters[rand(0, strlen($letters) - 1)];

        // Lấy 2 chữ số ngẫu nhiên
        $number = $numbers[rand(0, strlen($numbers) - 1)] . $numbers[rand(0, strlen($numbers) - 1)];

        // Kết hợp lại thành chuỗi
        return $letter . $number;
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'lastname' => ['required', 'string', 'max:255'], // Họ
            'firstname' => ['required', 'string', 'max:255'], // Tên
            'email' => ['required', 'string', 'email', 'max:255', 'unique:account'], // Email phải là duy nhất
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
            'date' => ['required', 'date'], // Ngày sinh
        ], [
            // Custom error messages
            'password.regex' => 'Mật khẩu phải chứa ít nhất 1 chữ thường, 1 chữ hoa, 1 số và 1 ký tự đặc biệt.',
            'email.unique' => 'Email đã được đăng ký.',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Account
     */
    protected function create(array $data)
    {
        $secret = Secret::create([
            'content' => $this->generateRandomContext(),  // Bạn có thể thay đổi nội dung hoặc tạo ngẫu nhiên
        ]);
        return Account::create([
            'secret_id' => $secret->id,  // Thêm secret_id
            'lastname' => $data['lastname'],    // Thêm họ
            'firstname' => $data['firstname'],  // Thêm tên
            'date' => $data['date'],            // Thêm ngày sinh
            'email' => $data['email'],          // Thêm email
            'password' => Hash::make($data['password']), // Mã hóa mật khẩu
            'role' => "customer",            // Thêm vai trò
            'image' => $data['image'] ?? 'default-avatar.png',  // Thêm hình ảnh (nếu có)
            'status' => 1, // Trạng thái mặc định là active
            'created_at' => now(),
        ]);
    }
}
