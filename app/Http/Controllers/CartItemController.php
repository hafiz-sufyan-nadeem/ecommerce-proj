<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;

class CartItemController extends Controller
{
    // ADD TO CART
    public function addToCart(Request $request)
    {
        // Validate input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $userId  = auth()->id();

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        // Check stock
        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        // Check if product already in cart
        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity    += $request->quantity;
            $cartItem->total_price  = $cartItem->quantity * $product->price;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id'     => $userId,
                'product_id'  => $product->id,
                'quantity'    => $request->quantity,
                'price'       => $product->price,
                'total_price' => $request->quantity * $product->price,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // GET ALL CART ITEMS FOR LOGGED IN USER
    public function getCartItems()
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['error' => 'User not logged in'], 401);
        }

        $cartItems = CartItem::where('user_id', $userId)
            ->with('product')
            ->get();

        $totalPrice = $cartItems->sum('total_price');

        return response()->json([
            'items'      => $cartItems,
            'totalPrice' => $totalPrice,
        ]);
    }

    // UPDATE QUANTITY OF AN ITEM
    public function updateQuantity(Request $request)
    {
        $request->validate([
            'id'       => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::findOrFail($request->id);
        $cartItem->quantity     = $request->quantity;
        $cartItem->total_price  = $cartItem->quantity * $cartItem->price;
        $cartItem->save();

        return response()->json(['success' => true]);
    }

    // DELETE ITEM FROM CART
    public function deleteItem(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:cart_items,id',
        ]);

        $cartItem = CartItem::findOrFail($request->id);
        $cartItem->delete();

        return response()->json(['success' => true]);
    }
}
