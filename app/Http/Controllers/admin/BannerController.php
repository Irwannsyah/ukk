<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Banner';
        $data['banners'] = Banner::all();
        return view('admin.banner.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Add Banner';
        return view('admin.banner.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $filename = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/banner/'), $filename);
        }

        $banner = new Banner();
        $banner->name = $request->name;
        $banner->image = $filename;
        $banner->save();

        return redirect()->route('banner.list')->with('success', 'Banner Created Success');
    }

    public function edit($id){
        $data['header_title'] = 'Update Banner';
        $data['getSingle'] = Banner::getSingle($id);
        return view('admin.banner.edit', $data);
    }

    public function update($id, Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $banner = Banner::getSingle($id);
        $banner->name = $request->name;
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($banner->image && file_exists(public_path('uploads/banner/' . $banner->image))) {
                unlink(public_path('uploads/banner/' . $banner->image));
            }

            // Upload gambar baru
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/banner/'), $filename);
            $banner->image = $filename;
        }

        $banner->save();

        return redirect()->route('banner.list')->with('success', 'Banner Update Successfully');
    }

    public function delete($id){
        $banner = Banner::getSingle($id);
        $banner->delete();
        return redirect()->route('banner.list')->with('success', 'Delete Banner Successfully');
    }
}
