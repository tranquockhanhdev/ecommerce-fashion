<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $table = 'category';


    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'image',
        'status',
    ];


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id'); // Một danh mục có thể có một danh mục cha
    }


    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id'); // Một danh mục có thể có nhiều danh mục con
    }


    public function products()
    {
        return $this->hasMany(Product::class); // Một danh mục có thể có nhiều sản phẩm
    }
}
