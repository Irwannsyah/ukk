<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\destination;
use App\Models\Gallery;
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
        $request->validate([
            'title' => 'required|string|max:255',
            'images' => 'required|array',
            'images.*' => 'image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $destination = new destination();
        $destination->title = $request->title;
        $destination->city = $request->city;
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

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/destination/'), $filename);

                $galleryImage = new Gallery();
                $galleryImage->destination_id = $destination->id; // Hubungkan gambar dengan destinasi
                $galleryImage->image = 'uploads/destination/' . $filename;
                $galleryImage->save(); 
            }
        }


        return redirect()->route('destination.list')->with('success', 'Create Destination Successfully');
    }

    public function edit($id){
        $data['header_title'] = 'Edit Destination';
        $data['select'] = Category::all(); // Ambil semua kategori yang tersedia
        $data['get_record'] = destination::getSingle($id);
        $data['get_category'] = Category::getCategory();
        return view('admin.destination.edit', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:destination,slug,' . $id,
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:png,jpg,jpeg|max:2048'
        ]);

        // Ambil data destination berdasarkan ID
        $destination = Destination::findOrFail($id);
        $destination->title = trim($request->title);
        $destination->city = trim($request->city);
        $destination->slug = trim($request->slug);
        $destination->category_id = trim($request->category_id);

        // Pastikan format harga tetap konsisten
        $price = str_replace('.', '', $request->price);
        $destination->price = $price;

        $destination->latitude = trim($request->latitude);
        $destination->longitude = trim($request->longitude);
        $destination->short_description = trim($request->short_description);
        $destination->description = trim($request->description);
        $destination->additional_information = trim($request->additional_information);
        $destination->status = trim($request->status);
        $destination->save();

        // **Hapus gambar lama jika ada gambar baru**
        if ($request->hasFile('images')) {
            // Hapus gambar lama dari database dan folder
            $oldImages = Gallery::where('destination_id', $destination->id)->get();
            foreach ($oldImages as $oldImage) {
                if (file_exists(public_path($oldImage->image))) {
                    unlink(public_path($oldImage->image)); // Hapus file
                }
                $oldImage->delete(); // Hapus data dari database
            }

            // Simpan gambar baru
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/destination/'), $filename);

                $galleryImage = new Gallery();
                $galleryImage->destination_id = $destination->id;
                $galleryImage->image = 'uploads/destination/' . $filename;
                $galleryImage->save();
            }
        }

        return redirect()->route('destination.list')->with('success', 'Destination successfully updated.');
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
