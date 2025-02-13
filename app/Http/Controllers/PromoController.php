<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromoCode;

class PromoController extends Controller
{
    public function applyPromoCode(Request $request)
    {
        $promoCode = $request->input('promo_code');
        $totalCost = $request->input('total_cost');

        $promo = PromoCode::where('code', $promoCode)->first();

        if ($promo) {
            $discountAmount = ($promo->discount_percentage / 100) * $totalCost;
            $newTotalPrice = $totalCost - $discountAmount;

            return response()->json([
                'success' => true,
                'promo_code' => $promoCode,
                'discount' => number_format($discountAmount),
                'new_total_price' => number_format($newTotalPrice),
            ]);

        }
        return response()->json([
            'success' => false,
            'message' => 'Invalid Promo Code'
        ]);
    }
}
