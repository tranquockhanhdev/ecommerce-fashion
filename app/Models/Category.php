<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category'; 
    protected $fillable = [
       'id','parent_id','name','slug','image','status','created_at','update_at'
    ];

    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Hiện' : 'Ẩn';
    }
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value == 'Hiện') ? 1 : 0;
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}