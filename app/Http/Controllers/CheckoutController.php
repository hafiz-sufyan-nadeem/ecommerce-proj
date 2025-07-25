<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Log;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    public function checkout(Request $request) {
        $user = auth()->user();
        $userId = $request->user_id;

        $cartItems = CartItem::where('user_id', $userId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your Cart is empty.');
        }

        $products = $cartItems->pluck('product');

        $totalPrice = $cartItems->sum('total_price');

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
            'name' => 'required',
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

        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();
        $totalPrice = $cartItems->sum('total_price');

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Cart is empty!');
        }

        $cartSnapshot = $cartItems->map(function ($item) {
            return [
                'product_id' => $item->product->id ?? null,
                'product_name' => $item->product->name ?? 'N/A',
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total' => $item->total_price
            ];
        })->toArray();

        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'country' => $request->country,
            'payment_method' => $request->payment_method,
            'card_name' => $request->card_name,
            'card_number' => $request->card_number,
            'card_expiration' => $request->card_expiration,
            'card_cvv' => $request->card_cvv,
            'total_price' => $totalPrice,
            'cart_items' => json_encode($cartSnapshot),    //Ye PHP ka array (jo ek full cart snapshot hai) ko JSON string me convert karta hai, taake hum usse ek TEXT column me database me save kar saken.
            //Baad me usse json_decode karke dobara array bana ke show kar lete hain.
        ]);

        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('thankyou')->with('success', 'Order placed successfully!');
    }


}
