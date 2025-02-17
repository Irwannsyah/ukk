<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\destination;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'city' => 'required|string|max:255',
        //     'slug' => 'required|string|max:255|unique:destination,slug',
        //     'category_id' => 'required|exists:category,id',
        //     'latitude' => 'required|numeric|between:-90,90',
        //     'longitude' => 'required|numeric|between:-180,180',
        //     'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        //     'short_description' => 'required|string|max:500',
        //     'quota_ticket' => 'required|integer|min:1',
        //     'description' => 'required|string',
        //     'additional_information' => 'required|string',
        //     'status' => 'required|in:active,inactive'
        // ]);
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/destination/'), $filename);
                $imageNames[] = $filename; // Menyimpan nama file
            }
        }

        $destination = new destination();
        $destination->title = $request->title;
        $destination->city = $request->city;
        $destination->images = json_encode($imageNames); 
        $destination->slug = $request->slug;
        $destination->category_id= $request->category_id;
        $price = str_replace('.', '', $request->price);
        $destination->price = $price;
        $destination->open_time = $request->open_time;
        $destination->closed_time = $request->closed_time;
        $destination->latitude = $request->latitude;
        $destination->longitude = $request->longitude;
        $destination->short_description = $request->short_description;
        $destination->quote_ticket = $request->quota_ticket;
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
        $destination->latitude = trim($request->latitude);
        $destination->longitude = trim($request->longitude);
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

    public function view($id){
        $data['get_destination'] = destination::getSingle($id);
        return view('admin.destination.view', $data);
    }
}
