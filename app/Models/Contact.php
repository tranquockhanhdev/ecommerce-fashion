<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact';
    protected $fillable = [
        'user_name', 'email', 'title', 'content', 'status', 'created_at', 'updated_at'
    ];

    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'đã xử lý' : 'chưa xử lý';
    }

    // Khi lưu trạng thái, chuyển từ chuỗi thành số
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value == 'đã xử lý') ? 1 : 0;
    }
}
