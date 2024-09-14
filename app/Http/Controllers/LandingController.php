<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->take(6)->get();
        return view('welcome', compact('courses'));
    }

    public function submitContact(Request $request)
    {
        // Validate and handle contact form submission logic
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Store or send the message
        // ...

        return redirect()->back()->with('success', 'Thank you for your message!');
    }
}
