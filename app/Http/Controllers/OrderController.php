<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\CartItem;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'address'        => 'required|string',
            'payment_method'  => 'required|string',
        ]);

        $userId = auth()->id();

        $cartItems = CartItem::where('user_id', $userId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum('total_price');

        // 2. Order row create
        $order = new Order();
        $order->user_id     = $userId;
        $order->name        = $request->name;
        $order->last_name   = $request->last_name;
        $order->email       = $request->email;
        $order->country     = $request->country;
        $order->card_name = $request->card_name;
        $order->card_number = $request->card_number;
        $order->card_expiration = $request->card_expiration;
        $order->card_cvv = $request->card_cvv;

        $order->total_price = $total;
        $order->address     = $request->address;
        $order->payment_method = $request->payment_method;
        $order->status      = 'pending';
        $order->save();


        // 3. Har cart item → OrderItem mein daalo
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'    => $order->id,
                'product_id'  => $item->product_id,
                'quantity'    => $item->quantity,
                'price'       => $item->price,
                'total_price' => $item->total_price,
            ]);

            //  4. Stock reduce karo
            $product = $item->product;
            $product->stock -= $item->quantity;
            if ($product->stock < 0) {
                $product->stock = 0;
            }

            $product->save();

        }

        //  5. Cart clear
        CartItem::where('user_id', $userId)->delete();
        session()->forget(['cart_items', 'cart_total']);

        return redirect()->route('thankyou')->with('success', 'Order placed successfully!');
    }
}
