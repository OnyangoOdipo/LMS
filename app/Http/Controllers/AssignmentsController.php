<?php

namespace App\Http\Controllers;

use App\Models\Assignments;
use App\Models\AssignmentSubmission;
use App\Models\Progress; // Ensure this is the correct model for progress tracking
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
    public function show($assignmentId)
    {
        $assignment = Assignments::findOrFail($assignmentId);
        return view('teacher.assignments.show', compact('assignment'));
    }

    // Show submissions for a specific assignment
    public function showSubmissions($assignmentId)
    {
        $assignment = Assignments::with('submissions.student')->findOrFail($assignmentId);
        return view('teacher.assignments.submissions', compact('assignment'));
    }

    // Grade an assignment submission
    public function gradeSubmission(Request $request, $submissionId)
    {
        $request->validate([
            'score' => 'required|integer|min:0|max:10',
        ]);

        $submission = AssignmentSubmission::findOrFail($submissionId);

        // Update the score
        $submission->score = $request->score;
        $submission->save();

        // Update the progress table
        Progress::updateOrCreate(
            [
                'student_id' => $submission->student_id,
                'assignment_id' => $submission->assignment_id,
            ],
            [
                'score' => $request->score,
            ]
        );

        return redirect()->route('teacher.assignments.submissions', ['assignment' => $submission->assignment_id])
            ->with('success', 'Assignment graded successfully.');
    }

    // Handle assignment submission by a student
    public function submitAssignment(Request $request, $assignmentId)
    {
        $request->validate([
            'submission_file' => 'required|file|mimes:pdf,docx,jpg,png',
        ]);

        $submissionPath = $request->file('submission_file')->store('assignments/submissions', 'public');

        AssignmentSubmission::create([
            'assignment_id' => $assignmentId,
            'student_id' => Auth::id(),
            'submission_file' => $submissionPath,
        ]);

        return redirect()->route('assignments.index')->with('success', 'Assignment submitted successfully.');
    }

    public function studentIndex()
    {
        $studentId = Auth::id();
        $assignments = Assignments::where('cohort', Auth::user()->cohort)
            ->with('submissions')
            ->get();

        return view('assignments.index', compact('assignments'));
    }
}
