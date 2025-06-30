<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id()->get);
        return view('wishlist.index', compact('wishlists'));
    }

    public function store(Request $request)
    {
        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->get('product_id'))->exists();

        if ($exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $request->get('product_id'),
            ]);
            return redirect()->back()->with('success', 'Product added to wishlist');
        }
    }

    public function destroy($id)
    {

    }
}
