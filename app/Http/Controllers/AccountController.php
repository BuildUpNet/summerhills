<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\wishlist;
use App\Models\ProductReview;
use App\Models\WebsiteSetting;

class AccountController extends Controller
{
  public function accountUser()
{
    $user = Auth::user();

    $reviews = ProductReview::with('product')
                ->where('user_id', $user->id)
                ->get();

    $wishlist = wishlist::with('product')
                ->where('user_id', $user->id)
                ->get();

    $ordersCount = 0; // You can replace this with actual order count later
    $reviewsCount = count($reviews);
    $wishlistCount = $wishlist->count();
    $yearsSinceRegistration = now()->diffInYears($user->created_at);
    
    $settings = WebsiteSetting::first();

    return view('account', compact(
        'settings',
        'reviews',
        'wishlist',
        'ordersCount',
        'reviewsCount',
        'wishlistCount',
        'yearsSinceRegistration'
    ));
}


  public function updateAccount(Request $request)
{
    $user = Auth::user();

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');

       
        $safeName = preg_replace('/[^A-Za-z0-9]/', '_', strtolower($user->name));
        $filename = $safeName . '_' . time() . '.' . $image->getClientOriginalExtension();

      
        $destinationPath = public_path('profile_images');

      
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

      
        $image->move($destinationPath, $filename);

      
        $data['profile_image'] = 'profile_images/' . $filename;
    }

    $user->update($data);

    return back()->with('success', 'Profile updated successfully.');
}

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password changed successfully.');
    }
  public function index()
{
     $customers = User::where('role', 'user')
        ->with(['wishlist.product'])
        ->paginate(10);

    return view('Admin.customer-detail', compact('customers'));
}

}
