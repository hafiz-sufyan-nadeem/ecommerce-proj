<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        $promoCode = $request->input('Dis_code');
        $totalCost = $request->input('T_cost');

        $discount = 0;

        if ($promoCode == 'EXAMPLECODE') {
            $discount = 5;
        } else {
            $discount = 0;
        }

        $updatedPrice = $totalCost - $discount;

        return response()->json([
            'updated_price' => $updatedPrice,
            'discount' => $discount
        ]);
    }
}
