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

        $products = $cartItems->pluck('product'); // Prroducts ki info le raha

        $totalPrice = $cartItems->sum('total_price'); // Price Total

        return view('website.checkout',[
            'user' => $user,
            'cartItems' => $cartItems,
            'products' => $products,
            'totalPrice' => $totalPrice
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'country' => 'required',
            'payment_method' => 'required',
            'card_name' => 'required',
            'card_number' => 'required',
            'card_expiration' => 'required',
            'card_cvv' => 'required',
        ]);

        Order::create([
            'user_id' => Auth::id(),  // assuming user login hai
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'address2' => $request->address2,
            'country' => $request->country,
            'payment_method' => $request->payment_method,
            'card_name' => $request->card_name,
            'card_number' => $request->card_number,
            'card_expiration' => $request->card_expiration,
            'card_cvv' => $request->card_cvv,
        ]);

        return redirect()->back()->with('success', 'Order placed successfully!');
    }


}
