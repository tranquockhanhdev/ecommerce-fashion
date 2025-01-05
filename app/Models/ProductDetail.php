<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;


    protected $table = 'product_detail';


    protected $fillable = [
        'product_id',
        'colorproduct_id',
        'sizeproduct_id',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function color()
    {
        return $this->belongsTo(ColorProduct::class, 'colorproduct_id');
    }


    public function size()
    {
        return $this->belongsTo(SizeProduct::class, 'sizeproduct_id');
    }
}
