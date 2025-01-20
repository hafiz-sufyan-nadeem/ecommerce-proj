<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;

class CartItemController extends Controller
{
    public function addToCart(Request $request){
        $product = Product::findOrFail($request->productId);

        if (!$product){
            return redirect()->back()->with('error', 'Product not found');
        }

        $userId = auth()->id();
        if (!$userId){
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $existingCartItem = CartItem::where('user_id', $userId)->where('product_id', $request->productId)->first();
        if ($existingCartItem){
            $existingCartItem->quantity += 1;
//            $existingCartItem->price += $product->price;
            $existingCartItem->total_price = $existingCartItem->quantity * $product->price; // Total Price Update
            $existingCartItem->save();
        }else{
            CartItem::create([
                'user_id' => $userId,
                'product_id' => $request->productId,
                'quantity' => $request->quantityId,
                'price' => $product->price,
                'total_price' => $request->quantityId * $product->price,// Total Price
            ]);
        }
    }

    public function getCartItems()
    {
        $userId = auth()->id();
        if (!$userId) {
            return response()->json(['error' => 'User not logged in'], 401);
        }

        $cartItems = CartItem::where('user_id', $userId)
            ->with('product') // Load the product relationship properly
            ->get();

        $totalPrice = $cartItems->sum('total_price');

        return response()->json([
            'items' => $cartItems, // Return all items with their details
            'totalPrice' => $totalPrice,
        ]);
    }





}
