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
            return response()->json(['error' => 'User not logged in']);
        }

        $cartItems = CartItem::where('user_id', $userId)
            ->with('product')
            ->get();


        $totalPrice = $cartItems->sum('total_price');

        return response()->json([
            'items' => $cartItems,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function removeFromCart($id){
        $userId = auth()->id();
        if (!$userId){
            return redirect()->route('login')->with('error', 'Please login first');
        }

        $cartItem=CartItem::where('user_id', $userId)->where('product_id', $id)->first();
        if (!$cartItem){
            return redirect()->back()->with('error', 'Cart item not found');
        }
        $cartItem->delete();
    }

    public function updateCartItem(Request $request, $id){
        $userId = auth()->id();
        if (!$userId){
            return redirect()->route('login')->with('error', 'Please login first');
        }
        $cartItem = CartItem::where('user_id', $userId)->where('product_id', $id)->first();
        if (!$cartItem){
            return redirect()->back()->with('error', 'Cart item not found');
        }
        $request->validate([
            'quantity' => 'required',
        ]);
        $cartItem->quantity = $request->quantity;
        $cartItem->total_price = $cartItem->quantity * $cartItem->price;
        $cartItem->save();

    }

}
