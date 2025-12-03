<?php
namespace App\Http\Controllers;

use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WebsiteSettingController extends Controller
{
    public function edit()
    {
        $settings = WebsiteSetting::firstOrCreate([]);
        return view('Admin.website-setting', compact('settings'));
    }

public function update(Request $request)
{
   $request->validate([
    'logo'               => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'banner_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
    'about_image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
    'banner_tagline'     => 'nullable|string|max:255',
    'about_heading'      => 'nullable|string|max:255',
    'about_description'  => 'nullable|string|max:2000',
    'year_of_exp'        => 'nullable|integer|min:0',
]);


    $settings = WebsiteSetting::firstOrCreate([]);

    // Upload directory inside /public
    $uploadPath = public_path('uploads');

    if (!file_exists($uploadPath)) {
        mkdir($uploadPath, 0755, true);
    }

    // Logo
    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move($uploadPath, $filename);
        $settings->logo = 'uploads/' . $filename;
    }

    // Banner
    if ($request->hasFile('banner_image')) {
        $file = $request->file('banner_image');
        $filename = 'banner_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move($uploadPath, $filename);
        $settings->banner_image = 'uploads/' . $filename;
    }

    // About Image
    if ($request->hasFile('about_image')) {
        $file = $request->file('about_image');
        $filename = 'about_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move($uploadPath, $filename);
        $settings->about_image = 'uploads/' . $filename;
    }

    $settings->year_of_exp = $request->input('year_of_exp');

    $settings->banner_tagline     = $request->input('banner_tagline');
    $settings->about_heading      = $request->input('about_heading');
    $settings->about_description  = $request->input('about_description');
$settings->mission_heading = $request->mission_heading;
$settings->mission_text = $request->mission_text;
$settings->vision_heading = $request->vision_heading;
$settings->vision_text = $request->vision_text;
$settings->team_heading = $request->team_heading;
$settings->team_text = $request->team_text;

$settings->save();


    return redirect()->back()->with('success', 'Settings updated successfully!');
}

    
}
