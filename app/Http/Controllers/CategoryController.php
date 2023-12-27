<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    public function create()
    {
        return view('admin.add_category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|unique:categories|regex:/^[a-zA-Z ]+$/',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = 1;
        $category->save();

        Toastr::success('New Category Added Successfully!', 'Success');
        return redirect()->back();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.edit_category', compact('category'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|regex:/^[a-zA-Z ]+$/',
        ]);
        $id = $request->id;
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        Toastr::success('Category Updated successfully!', 'Success');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $category = Category::findOrFail($id);
        $category->delete();

        Toastr::success('Product Deleted Successfully :)', 'Success');
        return redirect()->back();
    }
}
