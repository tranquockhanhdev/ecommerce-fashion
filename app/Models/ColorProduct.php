<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorProduct extends Model
{
    use HasFactory;

    protected $table = 'color_product'; 

    
    protected $fillable = [
        'product_id',
        'color_name', // Tên màu
    ];

    
    public function product()
    {
        return $this->belongsTo(Product::class); // Mỗi màu sản phẩm thuộc về một sản phẩm
    }

    
    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class, 'colorproduct_id'); // Mỗi màu có thể có nhiều chi tiết sản phẩm
    }
}
