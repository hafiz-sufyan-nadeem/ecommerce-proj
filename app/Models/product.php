<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'image',
        'price',
        'category',
        'quantity',
        'stock',
        'is_featured',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function cartIem()
    {
        return $this->hasMany('Cartitem', 'product_id', 'id');
    }
}
