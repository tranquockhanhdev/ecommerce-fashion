<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_item';
    protected $fillable = ['cart_id', 'product_id', 'quantity', 'price'];

    // Quan hệ n-1: Mục giỏ hàng thuộc về một giỏ hàng
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    // Quan hệ n-1: Mục giỏ hàng thuộc về một sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
