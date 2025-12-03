<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    
    public function settings()
    {
        $admin = Auth::user();
        return view('Admin.settings', compact('admin'));
    }

public function updateProfile(Request $request)
{
    $admin = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $admin->id,
        'phone' => 'nullable|string|max:15',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $data = $request->only('name', 'email', 'phone');

   
    if ($request->hasFile('profile_image')) {

       
        if ($admin->profile_image && file_exists(public_path('profile_images/'.$admin->profile_image))) {
            unlink(public_path('profile_images/'.$admin->profile_image));
        }

        $imageName = time() . '_' . $request->file('profile_image')->getClientOriginalName();
        $request->file('profile_image')->move(public_path('profile_images'), $imageName);
        $data['profile_image'] = $imageName;
    }

    $admin->update($data);

    return redirect()->route('admin.profile')->with('success_profile', 'Profile updated successfully.');
}


  public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $admin = Auth::user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }

        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('admin.profile')->with('success_password', 'Password updated successfully.');
    }
}
