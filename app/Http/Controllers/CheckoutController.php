<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    public function checkout(Request $request) {
        dd($request->all());
        $userId = $request->user_id; // URL se user ID le raha hai

        // User ke cart items fetch karo
        $cartItems = CartItem::where('user_id', $userId)->with('product')->get();

//        if ($cartItems->isEmpty()) {
//            return redirect()->back()->with('error', 'Your cart is empty.');
//        }

        return view('website.checkout', [
            'cartItems' => $cartItems,
        ]);
    }

}
