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

    // Quan hệ với bảng ảnh (hasMany)
    public function images()
    {
        return $this->hasMany(ImageProduct::class);
    }

    // Quan hệ với bảng chi tiết sản phẩm (hasMany)
    public function details()
    {
        return $this->hasMany(ProductDetail::class);
    }

    // Quan hệ với bảng danh mục (belongsTo)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
