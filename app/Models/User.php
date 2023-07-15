<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function shopping_carts()
    {
        return $this->hasMany(ShoppingCart::class);
    }
}
