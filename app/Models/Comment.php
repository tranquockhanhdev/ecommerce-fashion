<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $fillable = [
        'id',
        'product_id',
        'account_id',
        'content',
        'rating',
        'status',
        'created_at',
        'update_at'
    ];
    // Quan hệ với model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Quan hệ với model Account
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
