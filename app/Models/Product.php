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
    // Mối quan hệ với bảng ImageProduct
    public function images()
    {
        return $this->hasMany(ImageProduct::class);
    }

    // Mối quan hệ với bảng ProductDetail

    public function details() //+
    {
        return $this->hasMany(ProductDetail::class);
    }
}
