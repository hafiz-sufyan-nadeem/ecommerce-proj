<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;          //  👈  stock kam karne ko product model chahiye

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // 1️⃣  Validation
        $request->validate([
            'address'        => 'required|string',
            'paymentMethod'  => 'required|string',
        ]);

        // 2️⃣  Cart items le lo  (jitni teri app ki logic ho)
        // Example: session me cart_items JSON padha hai
        $cartItems = json_decode(session('cart_items', '[]'), true);   // expect [ [product_id, quantity], ... ]
        if (empty($cartItems)) {
            return back()->with('error', 'Cart is empty!');
        }

        // 3️⃣  Total nikalo
        $total = 0;
        foreach ($cartItems as $ci) {
            $product = Product::find($ci['product_id']);
            if ($product) {
                $total += $product->price * $ci['quantity'];
            }
        }

        // 4️⃣  Order row banao
        $order              = new Order();
        $order->user_id     = auth()->id();
        $order->total_price = $total;
        $order->address     = $request->address;
        $order->payment_method = $request->paymentMethod;
        $order->cart_items  = json_encode($cartItems);   // pura snapshot save
        $order->status      = 'pending';
        $order->save();

        // 5️⃣  STOCK ↓  karo
        foreach ($cartItems as $ci) {
            $product = Product::find($ci['product_id']);
            if ($product) {
                $product->stock -= $ci['quantity'];
                if ($product->stock < 0) { $product->stock = 0; }
                $product->save();
            }
        }

        // 6️⃣  Cart clear karo
        session()->forget(['cart_items','cart_total']);

        return redirect()->route('thankyou')
            ->with('success', 'Order placed & stock updated!');
    }
}
