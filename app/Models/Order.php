<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['vendor_id', 'shopping_list_id', 'status'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function shopping_list()
    {
        return $this->belongsTo(ShoppingList::class);
    }

    // public function reject()
    // {
    //     $this->status = 'rejected';
    // }

    // public function accept()
    // {
    //     $this->status = 'accepted';
    // }

    // public function pend()
    // {
    //     $this->status = 'pended';
    // }

    // public function done()
    // {
    //     $this->status = 'done';
    // }
}
