<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->latest()->get();
        $categories = ProductCategory::all();
        return view('Admin.subcategories.index', compact('subcategories', 'categories'));
    }
      public function create()
    {
        $subcategories = Subcategory::with('category')->latest()->get();
        $categories = ProductCategory::all();
        return view('Admin.subcategory', compact('subcategories', 'categories'));
    }

    public function store(Request $request)
    {
     $request->validate([
    'category_id' => 'required|exists:product_categories,id',
    'name' => 'required|string|max:255',
    'image' => 'nullable|image|max:2048',
]);


      $image = $request->file('image');
$filename = time().'_'.$image->getClientOriginalName();
$image->move(public_path('subcategory'), $filename);

        Subcategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
           'image' => 'subcategory/' . $filename,
        ]);

        return back()->with('success', 'Subcategory created successfully.');
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('Admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
      $request->validate([
    'category_id' => 'required|exists:product_categories,id',
    'name' => 'required|string|max:255',
    'image' => 'nullable|image|max:2048',
]);


        $imagePath = $subcategory->image;
        if ($request->hasFile('image')) {
            if ($imagePath) Storage::disk('public')->delete($imagePath);
            $imagePath = $request->file('image')->store('subcategory', 'public');
        }

        $subcategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory updated successfully.');
    }

    public function destroy(Subcategory $subcategory)
    {
        if ($subcategory->image) {
            Storage::disk('public')->delete($subcategory->image);
        }
        $subcategory->delete();
        return back()->with('success', 'Subcategory deleted successfully.');
    }
}
