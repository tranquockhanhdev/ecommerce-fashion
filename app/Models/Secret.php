<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secret extends Model
{
    /** @use HasFactory<\Database\Factories\SecretFactory> */
    use HasFactory;
    protected $table = 'secret';
    public $timestamps = false;
    protected $fillable = [
        'content',
    ];

    public function account()
    {
        return $this->hasOne(Account::class, 'secret_id');
    }

    public function getContent()
    {
        return $this->attributes['secret_id'];
    }

    public function setContent($content)
    {
        $this->attributes['secret_id'] = $content;
    }
}
