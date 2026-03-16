<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Helper untuk hitung total harga
    public function getTotalAttribute()
    {
        return $this->product->price * $this->quantity;
    }
}