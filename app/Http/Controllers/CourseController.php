<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Fetch all courses to display in the admin view
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses', compact('courses'));
    }

    // Store a new course
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'duration' => 'required|integer',
            'description' => 'nullable|string',
            'price' => 'required|numeric'
        ]);

        Course::create($request->all());

        return redirect()->route('admin.courses')
                         ->with('success', 'Course created successfully.');
    }

    // Fetch a specific course for editing (used with AJAX)
    public function edit($id)
    {
        $course = Course::find($id);

        if ($course) {
            return response()->json($course);
        } else {
            return response()->json(['error' => 'Course not found.'], 404);
        }
    }

    // Update a specific course
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'duration' => 'required|integer',
            'description' => 'nullable|string',
            'price' => 'required|numeric'
        ]);

        $course = Course::find($id);

        if ($course) {
            $course->update($request->all());
            return redirect()->route('admin.courses')
                             ->with('success', 'Course updated successfully.');
        } else {
            return redirect()->route('admin.courses')
                             ->with('error', 'Course not found.');
        }
    }

    // Delete a specific course
    public function destroy($id)
    {
        $course = Course::find($id);

        if ($course) {
            $course->delete();
            return redirect()->route('admin.courses')
                             ->with('success', 'Course deleted successfully.');
        } else {
            return redirect()->route('admin.courses')
                             ->with('error', 'Course not found.');
        }
    }
}
