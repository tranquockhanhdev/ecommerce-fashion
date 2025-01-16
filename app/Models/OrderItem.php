<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_item';

    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'quantity',
        'price',
        'product_detail_id',
    ];

    // Quan hệ với Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Quan hệ với Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // OrderItem.php
public function product_detail()
{
    return $this->belongsTo(ProductDetail::class, 'product_detail_id');
}

}
