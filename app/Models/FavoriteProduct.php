<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteProduct extends Model
{
    /** @use HasFactory<\Database\Factories\WishlistProductFactory> */
    use HasFactory;
    protected $table = 'favourite_product';
    protected $fillable = [
        'account_id',
        'product_id',
        'status',
        'created_at',
        'updated_at'
    ];
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    // Quan hệ ngược với bảng product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
