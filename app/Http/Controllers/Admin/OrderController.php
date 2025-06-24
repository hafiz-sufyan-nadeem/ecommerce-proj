<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.orders.index', compact('orders'));
    }
}
