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
}
