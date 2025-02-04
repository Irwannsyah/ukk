<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\destination;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = 'Home Page';
        $data['get_record'] = destination::with('category')->get();
        $data['get_category'] = Category::with('destination')->get();
        $data['brands'] = Brand::all();
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
        $data['Destination'] = destination::with('category')->find($id);
        if(!$data['Destination']){
            return redirect()->back()->with('error', 'Destinasi Tidak ditemukan');
        }
        $data['header_title'] = 'Detail';
        return view('detail', $data);
    }

    public function category($id){
        $data['header_title'] = 'Category';
        $data['category'] = category::with('destination')->find($id);
        return view('category.list', $data);
    }
}
