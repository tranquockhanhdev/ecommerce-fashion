<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact'; // Đảm bảo bảng 'contact' được chỉ định chính xác
    protected $fillable = [
        'user_name', 'email', 'title', 'content', 'status', 'created_at', 'updated_at'
    ];

    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'đã duyệt' : 'chờ duyệt';
    }

    // Khi lưu trạng thái, chuyển từ chuỗi thành số
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value == 'đã duyệt') ? 1 : 0;
    }
}
