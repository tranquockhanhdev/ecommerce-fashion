<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';


    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'description',
        'quantity',
        'status',
    ];


    public $timestamps = true;
    protected $dates = ['deleted_at'];



    public function images()
    {
        return $this->hasMany(ImageProduct::class);
    }



    public function details()
    {
        return $this->hasMany(ProductDetail::class);
    }

    // Quan hệ với bảng danh mục (belongsTo)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    // Quan hệ với model Comment: Một sản phẩm có nhiều bình luận
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    // Quan hệ 1-n: Sản phẩm có thể nằm trong nhiều mục giỏ hàng
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }
}
