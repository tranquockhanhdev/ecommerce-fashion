<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    // Tên bảng (nếu không dùng tên mặc định là `accounts`)
    protected $table = 'account';

    // Các cột có thể được gán giá trị hàng loạt
    protected $fillable = [
        'secret_id',
        'lastname',
        'firstname',
        'date',
        'email',
        'password',
        'role',
        'image',
        'status',
        'created_at',
        'updated_at',
    ];

    // Định nghĩa quan hệ với model Order
    public function orders()
    {
        return $this->hasMany(Order::class, 'account_id');
    }
}
