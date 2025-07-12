<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $orders = Order::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->latest()->get();

        return view('admin.orders.index', compact('orders', 'status'));
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);

        // 👉 Only when moving to completed & not already completed
        if ($request->status === 'completed' && $order->status !== 'completed') {

            // cart_items JSON -> array
            $items = json_decode($order->cart_items ?? '[]', true);

            foreach ($items as $item) {
                // expect keys: product_id, quantity
                $product = Product::find($item['product_id'] ?? null);

                if ($product && isset($item['quantity'])) {
                    $product->stock -= $item['quantity'];
                    if ($product->stock < 0) { $product->stock = 0; }
                    $product->save();
                }
            }
        }

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Order status updated successfully!');
    }



    public function show(Order $order)
    {
        return view("admin.orders.show", compact('order'));
    }
}
