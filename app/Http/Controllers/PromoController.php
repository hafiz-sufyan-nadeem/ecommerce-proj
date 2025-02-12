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

        // Find promo code from the DB
        $promo = PromoCode::where('promo_code', $promoCode)->first();

        if ($promo) {
            // Apply discount logic
            $discountAmount = ($promo->discount_percentage / 100) * $totalCost;
            $newTotalPrice = $totalCost - $discountAmount;

            return response()->json([
                'success' => true,
                'promo_code' => $promoCode,
                'discount' => number_format($discountAmount, 2),
                'new_total_price' => number_format($newTotalPrice, 2),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid Promo Code'
        ]);
    }
}
