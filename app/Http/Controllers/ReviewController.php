<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request){
        $request->validate([
           'product_id' => 'required|exists:products,id',
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'required|string'
        ]);

        Review::create([
            'user_id'=>Auth::id(),
            'product_id'=>$request->product_id,
            'rating'=>$request->rating,
            'review'=>$request->review
        ]);
        return redirect()->back()->with('success','Review added successfully');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        if(auth()->id() == $review->user_id){
            return back()->with('error','You are not authorized to delete this review.');
        }
        $review->delete();

        return back()->with('success','Review deleted successfully');
    }
}
