<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list(){
        $data['get_record'] = Category::getCategory();
        $data['header_title'] = 'Category';
        return view('admin.category.list', $data);
    }

    public function add(){
        $data['header_title'] = 'Add Category';
        return view('admin.category.add', $data);
    }

    public function insert(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        $category = new Category();
        $filename = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/category/'), $filename);
        }
        $category->name = $request->name;
        $category->image = $filename;
        $category->slug = $request->slug;
        $category->save();

        return redirect()->route('category.list')->with('success', 'Catgory Successfully Created');
    }

    public function edit($id){
        $data['get_record'] = Category::getSingle($id);
        $data['header_title'] = 'Edit Category';
        return view('admin.category.edit', $data);
    }

    public function update($id, Request $request){
        request()->validate([
            'slug' => 'required|unique:category,slug,' . $id
        ]);
        $category = Category::getSingle($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();

        return redirect()->route('category.list')->with('success', 'Update Category Successfully');
    }

    public function delete($id){
        $category = Category::getSingle($id);
        if(!$category){
            return redirect()->route('category.list')->with('error', 'Category Not Found');
        }
        if ($category->image && file_exists(public_path('uploads/category/' . $category->image))) {
            unlink(public_path('uploads/category/' . $category->image)); // Hapus gambar dari folder
        }
        $category->delete();

        return redirect()->route('category.list')->with('success', 'Delete Category Successfully');
    }
}
