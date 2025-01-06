<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;

class CartItemController extends Controller
{
    public function addToCart($id){
        $product = Product::findOrFail($id);

        if (!$product){
            return redirect()->back()->with('error', 'Product not found');
        }

        $userId = auth()->id();
        if (!$userId){
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $existingCartItem = CartItem::where('user_id', $userId)->where('product_id', $id)->first();
        if ($existingCartItem){
            $existingCartItem->quantity += 1;
            $existingCartItem->price += $product->price;
            $existingCartItem->save();
        }else{
            CartItem::create([
                'user_id' => $userId,
                'product_id' => $id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }
    }
}
