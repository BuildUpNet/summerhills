<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
     
    public function index()
    {
        $categories = ProductCategory::latest()->get();
        return view('Admin.create-category', compact('categories'));
    }

    public function create()
    {
          $categories = ProductCategory::latest()->get();
        return view('Admin.create-category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $category = new ProductCategory();
        $category->name = $request->name;

        if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageName = time() . '_' . $image->getClientOriginalName();
    $image->move(public_path('uploads/categories'), $imageName);
    $category->image = 'uploads/categories/' . $imageName;
}

        $category->save();

        return back()->with('success', 'Category created successfully!');
    }

    public function edit(ProductCategory $category)
    {
        $categories = ProductCategory::latest()->get();
        return view('Admin.create-category', compact('category', 'categories'));
    }

    public function update(Request $request, ProductCategory $category)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $category->name = $request->name;

        if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/categories'), $imageName);
        $category->image = 'uploads/categories/' . $imageName;
    }

        $category->save();

        return back()->with('success', 'Category updated successfully!');
    }

    public function destroy(ProductCategory $category)
    {
        $category->delete();
        return back()->with('success', 'Category deleted successfully!');
    }
}

