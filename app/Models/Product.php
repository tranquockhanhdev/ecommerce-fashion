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



    public function details() //+
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // Mỗi sản phẩm thuộc về một danh mục
    }
}
