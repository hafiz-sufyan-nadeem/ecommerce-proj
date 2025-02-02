<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    public function checkout(Request $request) {
        $user = auth()->user();
        $userId = $request->user_id;

        $cartItems = CartItem::where('user_id', $userId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your Cart is empty.');
        }

        $products = $cartItems->pluck('product'); // Products ki info le raha

        $totalPrice = $cartItems->sum('total_price'); // Price Total

        return view('website.checkout',[
            'user' => $user,
            'cartItems' => $cartItems,
            'products' => $products,
            'totalPrice' => $totalPrice
        ]);
    }

}
