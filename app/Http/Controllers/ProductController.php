<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\WebsiteSetting;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;
use App\Models\Subcategory;

class ProductController extends Controller
{
       public function showByCategory($id)
{
   
    $category = ProductCategory::where('id', $id)->firstOrFail();
    $products = Product::where('category_id', $category->id)
        ->latest()
        ->paginate(9);
    return view('category-product', compact('category', 'products' ));
}
public function getSubcategories($categoryId)
{
    $subcategories = Subcategory::where('category_id', $categoryId)->get();
    return response()->json($subcategories);
}

 public function show(Request $request)
    {
        $query = Product::query();

        if ($request->filled('categories')) {
            $categoryNames = explode(',', $request->categories);

            $query->where(function ($q) use ($categoryNames) {
                $q->whereHas('category', function ($subQ) use ($categoryNames) {
                    $subQ->whereIn('name', $categoryNames);
                })
                ->orWhereHas('subcategory', function ($subQ) use ($categoryNames) {
                    $subQ->whereIn('name', $categoryNames);
                });
            });
        }

        if ($request->filled('age')) {
            $ages = explode(',', $request->age);
            $query->whereIn('year_old', $ages);
        }

        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

      $products = $query->paginate(9);


      
        $productCategories = ProductCategory::with('subcategories')->get();

        $settings = WebsiteSetting::first();
        $wishlistIds = [];

        if (Auth::check()) {
            $wishlistIds = Auth::user()->wishlist()->pluck('product_id')->toArray();
        }

        return view('product', compact('products', 'productCategories', 'settings', 'wishlistIds'));
    }
    public function single(Product $product)
    {
        return view('product-single', compact('product'));
    }
public function index(Request $request)
{
    $search = $request->input('search');
    $categoryId = $request->input('category_id');

    $products = Product::query()

        // Search filter
        ->when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('brand_name', 'like', "%{$search}%")
                  ->orWhere('year_old', 'like', "%{$search}%")
                  ->orWhere('alcohol_percentage', 'like', "%{$search}%");
            });
        })

        // Category filter
        ->when($categoryId, function ($query, $categoryId) {
            return $query->where('category_id', $categoryId);
        })

        ->latest()
        ->paginate(10);


    $categories = ProductCategory::all();

    return view('Admin.view-product', compact('products', 'search', 'categories'));
}


    public function create()
    {
        $categories = ProductCategory::all();
        return view('Admin.create-product', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'category_id' => 'required|exists:product_categories,id',
            'title'              => 'required|string|max:255',
            'slug'               => 'nullable|string|unique:products,slug|max:255',
            'short_description'  => 'nullable|string|max:255',
            'brand_name'         => 'nullable|string|max:255',
            'year_old'           => 'nullable|integer|min:0',
            'alcohol_percentage' => 'nullable|string|max:255',
            'description'        => 'required|string',
            'image'              => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('productimage'), $imageName);
            $imagePath = 'productimage/' . $imageName;
        }

       Product::create([
    'category_id'        => $request->category_id,
    'subcategory_id'     => $request->subcategory_id ?? null,
    'title'              => $request->title,
    'slug'               => $slug,
    'short_description'  => $request->short_description,
    'brand_name'         => $request->brand_name,
    'year_old'           => $request->year_old,
     'price'           => $request->price,
    'alcohol_percentage' => $request->alcohol_percentage,
    'description'        => $request->description,
    'image'              => $imagePath,
]);
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }


   public function edit(Product $product)
{
    $categories = ProductCategory::all(); // Get all categories
    return view('Admin.create-product', compact('product', 'categories'));
}


 public function update(Request $request, Product $product)
{
    $request->validate([
        'category_id'        => 'required|exists:product_categories,id',
        'subcategory_id'     => 'nullable|exists:subcategories,id',
        'title'              => 'required|string|max:255',
        'slug'               => 'nullable|string|unique:products,slug,' . $product->id,
        'short_description'  => 'nullable|string|max:255',
        'brand_name'         => 'nullable|string|max:255',
        'year_old'           => 'nullable|integer|min:0',
        'alcohol_percentage' => 'nullable|string|max:255',
        'description'        => 'required|string',
        'price'              => 'nullable|numeric|min:0',
        'image'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $slug = $request->slug ?? Str::slug($request->title);

    $imagePath = $product->image;

    if ($request->hasFile('image')) {
        // Delete old image if it exists
        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        // Upload new image
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('productimage'), $imageName);
        $imagePath = 'productimage/' . $imageName;
    }

    $product->update([
        'category_id'    => $request->category_id,
        'subcategory_id' => $request->subcategory_id ?? null,
        'title'          => $request->title,
        'slug'           => $slug,
        'short_description'  => $request->short_description,
        'brand_name'         => $request->brand_name,
        'year_old'           => $request->year_old,
        'alcohol_percentage' => $request->alcohol_percentage,
        'description'        => $request->description,
        'price'              => $request->price,
        'image'              => $imagePath,
    ]);

    return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
}


    public function destroy(Product $product)
    {
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }
       public function toggleBestProduct(Request $request)
{
    $product = Product::find($request->id);

    if (!$product) {
        return response()->json(['success' => false, 'message' => 'Product not found.']);
    }

    $product->best_product = $request->best_product;
    $product->save();

    return response()->json(['success' => true, 'message' => 'Best product status updated successfully.']);
}
public function filter(Request $request)
{
    $query = Product::with('category');

    if ($request->has('categories')) {
        $categories = explode(',', $request->categories);
        $query->whereHas('category', function ($q) use ($categories) {
            $q->whereIn('name', $categories);
        });
    }

    $products = $query->paginate(9);

    return response()->json([
        'html' => view('partials.product-cards', compact('products'))->render()
    ]);
}
public function SinglePage($slug)
{
    $product = Product::where('slug', $slug)->firstOrFail(); 
    $settings = WebsiteSetting::first();

    // Eager load reviews
    $reviews = $product->reviews()->latest()->get(); // assumes relation is set

    return view('product-single', compact('product', 'settings', 'reviews'));
}

public function storeReview(Request $request)
{
    if (!auth()->check() || auth()->user()->role !== 'user') {
        return redirect()->route('login')->with('error', 'Only users can submit reviews.');
    }

  
  $request->validate([
    'product_id' => 'required|exists:products,id',
    'rating' => 'required|integer|min:1|max:5',
    'comment' => 'required|string',
]);
   
    ProductReview::create([
       'user_id' => auth()->user()->id,
        'product_id'  => $request->product_id,
        'name'       => auth()->user()->name,  
        'email'      => auth()->user()->email,
        'rating'      => $request->rating,
        'comment'     => $request->comment,
    ]);

    return back()->with('success', 'Review submitted successfully!');
}
public function toggleBannerProduct(Request $request)
{
    $product = Product::find($request->id);

    if (!$product) {
        return response()->json(['success' => false, 'message' => 'Product not found.']);
    }

    // Count how many are already set as banner
    $bannerCount = Product::where('banner_product', true)->count();

    // If trying to activate and already 4 are active
    if ($request->banner_product == 1 && $bannerCount >= 4) {
        return response()->json([
            'success' => false,
            'message' => 'Only 4 banner products can be active at once.'
        ]);
    }

    $product->banner_product = $request->banner_product;
    $product->save();

    return response()->json([
        'success' => true,
        'message' => $request->banner_product
            ? 'Product added to banner successfully.'
            : 'Product removed from banner successfully.'
    ]);
}

}
