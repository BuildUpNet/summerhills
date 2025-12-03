<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AgeVerificationController extends Controller
{
    public function verify(Request $request)
    {
        // Just confirm flag
        if ($request->boolean('confirm')) {
            session(['age_verified' => true]);
            Cookie::queue('age_verified', '1', 60 * 24 * 30); // 30 days
            return response()->json(['status' => 'ok']);
        }

        return response()->json(['error' => 'Access Denied'], 403);
    }

    public function blocked()
    {
        return response("<h2 style='text-align:center;margin-top:100px;'>You must be 18+ to view this website.</h2>");
    }
}
