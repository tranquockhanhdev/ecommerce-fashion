<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeProduct extends Model
{
    use HasFactory;


    protected $table = 'size_product';

    protected $fillable = [
        'product_id',
        'sizename',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class); // Mỗi size sản phẩm thuộc về một sản phẩm
    }


    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class, 'sizeproduct_id'); // Mỗi size có thể có nhiều chi tiết sản phẩm
    }
}
