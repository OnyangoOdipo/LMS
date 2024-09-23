<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Admin;
use App\Models\Course;

class AnnouncementController extends Controller
{
    public function create()
    {
        $courses = Course::all();
        return view('teacher.announcements.create', compact('courses'));
    }

    public function index()
    {
        // Get the logged-in student
        $student = Auth::user();

        // Retrieve announcements based on the recipient type
        $announcements = Announcement::where('recipient_type', 'everyone')
            ->orWhere('recipient_type', 'cohort_' . $student->cohort)
            ->get();

        // Pass announcements to the view
        return view('announcements.index', compact('announcements')); // Make sure to point to the student view
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required',
            'recipient_type' => 'required|in:cohort_1,cohort_2,everyone',
            'urgency' => 'required|in:low,medium,high',
        ]);

        // Determine the logged-in user (either a teacher or admin)
        $user = auth()->guard('teacher')->user() ?? auth()->guard('admin')->user();

        // Create announcement with either teacher_id or admin_id
        Announcement::create([
            'title' => $request->title,
            'message' => $request->message,
            'recipient_type' => $request->recipient_type,
            'urgency' => $request->urgency,
            'teacher_id' => $user instanceof Teacher ? $user->id : null,
            'admin_id' => $user instanceof Admin ? $user->id : null,
        ]);

        return redirect()->route('teacher.announcements.index')->with('success', 'Announcement created successfully.');
    }
}
