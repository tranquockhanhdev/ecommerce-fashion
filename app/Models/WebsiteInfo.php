<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteInfo extends Model
{
    use HasFactory;
    protected $table = 'website_info';
    public $timestamps = false;
    protected $fillable = [
        'site_name',
        'email',
        'phone',
        'address',
        'logo',
        'updated_at'
    ];
}
