<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'vendor_id',
        'image_id',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function shopping_lists()
    {
        return $this->belongsToMany(ShoppingList::class);
    }
}
