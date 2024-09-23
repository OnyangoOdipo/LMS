<?php

namespace App\Http\Controllers;

use App\Models\Assignments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentsController extends Controller
{
    // Display a list of assignments
    public function index()
    {
        $teacher = Auth::user(); // Get the authenticated teacher
        $assignments = Assignments::where('teacher_id', $teacher->id)->get(); // Get all assignments by this teacher
        
        return view('teacher.assignments.index', compact('assignments', 'teacher'));
    }

    // Show the form for creating a new assignment
    public function create()
    {
        return view('teacher.assignments.create');
    }

    // Store a newly created assignment in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'instructions' => 'required',
            'cohort' => 'required|in:1,2',
            'deadline' => 'required|date',
            'resource' => 'nullable|file|mimes:pdf,docx,txt,jpg,png',
        ]);

        // If resource is attached, store it
        $resourcePath = null;
        if ($request->hasFile('resource')) {
            $resourcePath = $request->file('resource')->store('assignments/resources', 'public');
        }

        // Create the assignment
        Assignments::create([
            'title' => $request->input('title'),
            'instructions' => $request->input('instructions'),
            'cohort' => $request->input('cohort'),
            'deadline' => $request->input('deadline'),
            'resource' => $resourcePath,
            'teacher_id' => Auth::id(), // Automatically insert the logged-in teacher's ID
        ]);

        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment created successfully.');
    }

    // Display a specific assignment
    public function show(Assignments $assignment)
    {
        return view('teacher.assignments.show', compact('assignment'));
    }
}
