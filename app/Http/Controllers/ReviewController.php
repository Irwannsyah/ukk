<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function sendReview(Request $request){
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:10|max:500',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'destination_id' => $request->destination_id,
            'rating' => $request->rating,
            'comment' => $request->review
        ]);

        return redirect()->back()->with('success', 'Review Berhasil ditambahkan');
    }
}
