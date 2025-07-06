<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function orders()
    {
        return $this->belongsTo(orders::class, 'order_id');
    }   
    
    // public function reviews()
    // {
    //     return $this->hasOne(Review::class,'order_item_id');
    // }
}
