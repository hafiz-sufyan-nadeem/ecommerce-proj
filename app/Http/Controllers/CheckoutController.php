<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    public function checkout() {
        $products = DB::table('products')->get();

        return view('website.checkout',[
            'products'=>$products,
        ]);

    }
}
