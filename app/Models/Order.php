<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'name', 'last_name', 'email', 'address',
        'country', 'payment_method', 'card_name', 'card_number', 'card_expiration', 'card_cvv','total_price','status','cart_items'

    ];

}
