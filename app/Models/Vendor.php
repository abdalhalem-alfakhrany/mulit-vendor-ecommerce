<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
