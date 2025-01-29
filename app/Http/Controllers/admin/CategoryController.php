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
        $category = new Category();
        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
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
        $category->delete();

        return redirect()->route('category.list')->with('success', 'Delete Category Successfully');
    }
}
