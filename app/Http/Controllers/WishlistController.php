<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\WebsiteSetting;
use App\Models\wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Show all wishlist items for the authenticated user.
     */
    public function showWishlist()
    {
        $user = Auth::user();
 $settings = WebsiteSetting::first();
        // Get user's wishlist with product details
        $wishlistItems = wishlist::with('product')
                            ->where('user_id', $user->id)
                            ->get();

        return view('wishlist', compact('wishlistItems' , 'settings'));
    }

    /**
     * Add a product to the wishlist.
     */
    public function add(Product $product)
    {
        $user = Auth::user();

        if (!$user) {
            if (request()->ajax()) {
                return response()->json(['error' => 'Login required'], 401);
            }
            return redirect()->route('login');
        }

        // Check if already exists
        $exists = wishlist::where('user_id', $user->id)
                          ->where('product_id', $product->id)
                          ->exists();

        if (!$exists) {
            wishlist::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
        }

        $message = $exists
            ? 'Product already in wishlist!'
            : 'Product added to wishlist!';

        if (request()->ajax()) {
            return response()->json(['success' => $message]);
        }

        return back()->with('success', $message);
    }

    /**
     * Remove a product from the wishlist by product.
     */
 public function remove(Product $product)
{
    $user = Auth::user();

    Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->delete();

    return response()->json(['success' => 'Product removed from wishlist!']);
}

    /**
     * Remove a wishlist item by wishlist ID.
     */
    public function removeFromWishlist($id)
    {
        $user = Auth::user();

        $wishlist = wishlist::where('user_id', $user->id)
                            ->where('id', $id)
                            ->first();

        if ($wishlist) {
            $wishlist->delete();
        }

        return back()->with('success', 'Item removed from wishlist.');
    }
}
