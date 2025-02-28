<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;

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
            $existingCartItem->total_price = $existingCartItem->quantity * $product->price; // Total Price Update
            $existingCartItem->save();
        }else{
            CartItem::create([
                'user_id' => $userId,
                'product_id' => $request->productId,
                'quantity' => $request->quantityId,
                'price' => $product->price,
                'total_price' => $request->quantityId * $product->price,
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

    public function updateQuantity(Request $request)
    {
        $cartItem = CartItem::findOrFail($request->id);
        $cartItem->quantity = $request->quantity;
        $cartItem->total_price = $cartItem->quantity * $cartItem->price;
        $cartItem->save();

        return response()->json(['success' => true]);
    }


    public function deleteItem(Request $request)
    {
        $cartItem = CartItem::findOrFail($request->id);
        $cartItem->delete();

        return response()->json(['success' => true]);
    }

}
