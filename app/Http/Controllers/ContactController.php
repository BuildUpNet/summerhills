<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Models\ContactMessage;
use App\Models\WebsiteSetting;

class ContactController extends Controller
{
    public function contactpage()
    {
          $settings = WebsiteSetting::first();
        return view('contact' , compact('settings'));
    }

    public function submit(Request $request)
    {

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = ContactMessage::create($validated);
        Mail::to('tanyabatra949@gmail.com')->send(new ContactFormMail($validated));



        return back()->with('success', 'Your message has been sent successfully!');
    }
}
