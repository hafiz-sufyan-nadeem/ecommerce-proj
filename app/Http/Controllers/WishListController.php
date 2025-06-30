<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    /**  SHOW WISHLIST  **/
    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('website.wishlist', compact('wishlists'));
    }

    /**  ADD TO WISHLIST  **/
    public function store(Request $request)
    {
        // already‑exists guard
        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Already in wishlist!');
        }

        Wishlist::create([
            'user_id'    => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return back()->with('success', 'Product added to wishlist');
    }

    /**  REMOVE FROM WISHLIST  **/
    public function destroy($id)
    {
        $wish = Wishlist::findOrFail($id);

        if ($wish->user_id != Auth::id()) {
            return back()->with('error', 'Not allowed');
        }

        $wish->delete();
        return back()->with('success', 'Deleted from wishlist');
    }
}
