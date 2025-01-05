<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $table = 'order';
    public $timestamps = false;
    // Các cột có thể được gán giá trị hàng loạt
    protected $fillable = [
        'account_id',
        'status',
        'status_payment',
        'shipping_fee',
        'total',
        'delivery_at',
        'completed_at',
        'canceled_at',
        'created_at',
    ];

    // Định nghĩa quan hệ với model Account
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
