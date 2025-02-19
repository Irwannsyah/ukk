<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\destination;
use App\Models\Gallery;
use App\Models\payment;
use App\Models\Review;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        $data['header_title'] = 'Home Page';
        $data['get_category'] = Category::with('destination')->get();

        // Ambil semua destinasi dan cek apakah sudah ada di wishlist user
        $data['destination'] = Destination::with('gallery_image')
            ->get()
            ->map(function ($dest) use ($userId) {
                $dest->is_wishlisted = $dest->wishlist()->where('user_id', $userId)->exists();
                return $dest;
            });
        $data['brands'] = Brand::all();


        $data['banner'] = Banner::all();
        return view('dashboard', $data);
    }

    public function login()
    {
        $data['header_title'] = 'Login';
        return view('auth.login_user', $data);
    }
    public function register()
    {
        $data['header_title'] = 'Register';
        return view('auth.register_user', $data);
    }
    public function detail($id){
        $data['count'] = Destination::withCount('wishlist')->find($id);
        $data['Destination'] = destination::with('category', 'gallery_image')->find($id);
        if(!$data['Destination']){
            return redirect()->back()->with('error', 'Destinasi Tidak ditemukan');
        }
        $data['hasOrder'] = false;
        if(Auth::check()){
            $data['hasOrder'] = payment::where('user_id', Auth::id())
                    ->where('destination_id', $id)
                    ->where('status', 'settlement')
                    ->exists();
        }

        $data['HasReview'] = Review::where('user_id', Auth::id())
                                    ->where('destination_id', $id)
                                    ->exists();

        $data['header_title'] = 'Detail';

        $data['review'] = Review::with('user')
                                ->where('destination_id', $id)
                                ->orderBy('created_at', 'desc')
                                ->get();

        $data['review_count'] = Review::where('destination_id', $id)->count();
        $data['review_avg'] = Review::where('destination_id', $id)->avg('rating');
        return view('detail', $data);
    }

    public function category($id){
        $data['header_title'] = 'Category';
        $data['category'] = category::with('destination')->find($id);
        return view('category.list', $data);
    }
}
