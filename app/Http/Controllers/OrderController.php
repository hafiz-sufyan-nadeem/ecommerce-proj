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
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->total_price = $request->total_price;
        $order->save();

        return response()->json(['success' => true, 'message' => 'Order placed successfully!']);
    }
}

