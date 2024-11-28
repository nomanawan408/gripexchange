<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // index
    public function index(){
        return view('dashboard.contact-us.index');
    }

    // store
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        // Store the contact inquiry in the database
        Contact::create($validated);

        // Optionally, send a notification email (optional, see below)
        // \Mail::to('admin@example.com')->send(new ContactUsMail($validated));

        // Return a success response
        return redirect()->back()->with('success', 'Thank you for reaching out! We will get back to you soon.');
    }
    
    // show
        public function show()
        {
            $contact = Contact::all();
            return view('dashboard.contact-us.view', compact('contact'));
        }
    
}
