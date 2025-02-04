<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function list(){
        $data['header_title'] = 'Brand';
        $data['brands'] = Brand::all();
        return view('admin.brand.list', $data);
    }

    public function add(){
        $data['header_title'] = 'brand';
        return view('admin.brand.add', $data);
    }

    public function insert(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);


        $filename='';
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/brand/'), $filename);
        }


        $brand = new Brand();
        $brand->name = $request->name;
        $brand->image = $filename;
        $brand->save();

        return redirect()->route('brand.list')->with('success', 'Add Brand Successfully');
    }
}
