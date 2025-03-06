<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'email',
            'total_price' => 'numeric'
        ]);

        // Order Create Karein
        $order = new Order();
        $order->user_id = auth()->id();
        $order->total_price = session('cart_total'); // Total price session se lein
        $order->address = $request->address;
        $order->payment_method = $request->paymentMethod;
        $order->save();

        // Redirect with success message
        return redirect()->route('thankyou')->with('success', 'Your order has been placed successfully!');
    }
}

