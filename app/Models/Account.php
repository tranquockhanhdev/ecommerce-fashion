<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\AccountFactory> */
    use HasFactory, Notifiable;
    protected $table = 'account';
    public $timestamps = false;



    protected $fillable = [
        'secret_id',
        'lastname',
        'firstname',
        'date',
        'email',
        'password',
        'role',
        'image',
        'status',
        'created_at',
        'address',
        'phone',

    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getSecretId()
    {
        return $this->attributes['secret_id'];
    }

    public function setSecretId($secret_id)
    {
        $this->attributes['secret_id'] = $secret_id;
    }

    // Getter and Setter for 'lastname'
    public function getLastname()
    {
        return $this->attributes['lastname'];
    }

    public function setLastname($value)
    {
        $this->attributes['lastname'] = $value;
    }

    // Getter and Setter for 'firstname'
    public function getFirstname()
    {
        return $this->attributes['firstname'];
    }

    public function setFirstname($value)
    {
        $this->attributes['firstname'] = $value;
    }

    // Getter and Setter for 'date'
    public function getDate()
    {
        return $this->attributes['date'];
    }

    public function setDate($value)
    {
        $this->attributes['date'] = $value;
    }

    // Getter and Setter for 'email'
    public function getEmail()
    {
        return $this->attributes['email'];
    }

    public function setEmail($value)
    {
        $this->attributes['email'] = $value;
    }

    // Getter and Setter for 'password'
    public function getPassword()
    {
        return $this->attributes['password'];
    }

    public function setPassword($password)
    {
        $this->attributes['password'] = $password; // Bcrypt for security
    }

    // Getter and Setter for 'role'
    public function getRole()
    {
        return $this->attributes['role'];
    }

    public function setRole($role)
    {
        $this->attributes['role'] = $role;
    }

    // Getter and Setter for 'image'
    public function getImage()
    {
        return $this->attributes['image'];
    }

    public function setImage($image)
    {
        $this->attributes['image'] = $image;
    }

    // Getter and Setter for 'status'
    public function getStatus()
    {
        return $this->attributes['status'];
    }

    public function setStatus($status)
    {
        $this->attributes['status'] = $status;
    }

    // Getter and Setter for 'created_at'
    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($value = null)
    {
        $this->attributes['created_at'] = $value ?? now();
        // 'updated_at',
    }

    // Getter và Setter cho 'address'
    public function getAddress()
    {
        return $this->attributes['address'];
    }

    public function setAddress($value)
    {
        $this->attributes['address'] = $value;
    }

    // Getter và Setter cho 'phone'
    public function getPhone()
    {
        return $this->attributes['phone'];
    }

    public function setPhone($value)
    {
        $this->attributes['phone'] = $value;
    }

    // Quan hệ 1-Nhiều với bảng `OrderCustomer`
    public function orderCustomers()
    {
        return $this->hasMany(OrderCustomer::class, 'account_id');
    }
    /**
     * Quan hệ với bảng Order.
     */
    // Quan hệ với bảng OrderItem (1 tài khoản có nhiều OrderItems)

    // Quan hệ 1-n: Một tài khoản có nhiều giỏ hàng
    public function carts()
    {
        return $this->hasMany(Cart::class, 'account_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function favoriteProducts()
    {
        return $this->hasMany(FavoriteProduct::class, 'account_id', 'id');
    }
}
