<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class WishlistController extends Controller
{
    public function index(){
        $wishlist = Wishlist::where('user_id', Auth::id())
        ->with('destination.gallery_image')
        ->get();
        return view('wishlist.list', compact('wishlist'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destination,id'
        ]);

        $destinationId = $request->input('destination_id');
        $user = auth()->user();

        $wishlist = Wishlist::where('user_id', $user->id)
                            ->where('destination_id', $destinationId)
                            ->first();

        if($wishlist) {
            return redirect()->back()->with('error', 'Destinasi Sudah ada di wishlist');
        }

        Wishlist::create([
            'user_id' => $user->id,
            'destination_id' => $destinationId,
        ]);

        return redirect()->back()->with('wishlist', 'Destinasi berhasil ditambahkan di wishlist!');
    }

    public function remove(Request $request){
        Wishlist::where('user_id', Auth::id())
                ->where('destination_id', $request->destination_id)
                ->delete();
        return back()->with('wishlist', 'Berhasil ditambahkan ke Wishlist');
    }
}
