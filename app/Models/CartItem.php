<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';
    protected $fillable = ['user_id', 'product_id', 'quantity', 'price', 'total_price'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }


    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
