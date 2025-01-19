<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $fillable = ['account_id', 'created_at', 'updated_at'];

    // Quan hệ n-1: Giỏ hàng thuộc về một tài khoản
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    // Quan hệ 1-n: Giỏ hàng có nhiều sản phẩm (qua bảng cart_item)
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
}
