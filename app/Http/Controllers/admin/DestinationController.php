<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\destination;
use App\Models\Product;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Destination';
        $data['get_record'] = destination::with('category')->get();
        return view('admin.destination.list', $data);
    }

    public function add(){
        $data['header_title'] = 'Add Destination';
        $data['get_record'] = Category::getCategory();
        return view('admin.destination.add', $data);
    }

    public function insert(Request $request){
        $request->validate([
            'category_id' => 'required|exists:category,id',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $filename = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/destination/'), $filename);
        }

        $destination = new destination();
        $destination->title = $request->title;
        $destination->city = $request->city;
        $destination->image = $filename;
        $destination->slug = $request->slug;
        $destination->category_id= $request->category_id;
        $destination->price = $request->price;
        $destination->short_description = $request->short_description;
        $destination->description = $request->description;
        $destination->additional_information = $request->additional_information;
        $destination->status = $request->status;
        $destination->save();

        return redirect()->route('destination.list')->with('success', 'Create Destination Successfully');
    }

    public function edit($id){
        $data['header_title'] = 'Edit Destination';
        $data['get_record'] = destination::getSingle($id);
        $data['get_category'] = Category::getCategory();
        return view('admin.destination.edit', $data);
    }

    public function update($id, Request $request){
        request()->validate([
            'slug' => 'required|unique:category,slug,' . $id
        ]);

        $destination = destination::getSingle($id);
        $destination->title = trim($request->title);
        $destination->city = trim($request->city);
        $destination->slug = trim($request->slug);
        $destination->category_id = trim($request->category_id);
        $destination->price = trim($request->price);
        $destination->short_description = trim($request->short_description);
        $destination->description = trim($request->description);
        $destination->additional_information = trim($request->additional_information);
        $destination->status = trim($request->status);
        $destination->save();

        return redirect()->route('destination.list');
    }

    public function delete($id)
    {
        $destination = destination::getSingle($id);
        if (!$destination) {
            return redirect()->route('destination.list')->with('error', 'Destination Not Found');
        }
        if ($destination->image && file_exists(public_path('uploads/destination/' . $destination->image))) {
            unlink(public_path('uploads/destination/' . $destination->image)); // Hapus gambar dari folder
        }
        $destination->delete();

        return redirect()->route('destination.list')->with('success', 'Delete destination Successfully');
    }
}
