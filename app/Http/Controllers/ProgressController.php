<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Quiz;
use App\Models\Assignments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
    {
        $studentId = Auth::id();
        $student = Auth::user(); // Get the authenticated student

        // Retrieve progress data
        $progressData = Progress::where('student_id', $studentId)
            ->with(['quiz', 'assignment'])
            ->get();

        // Calculate the progress statistics
        $totalQuizzes = Quiz::where('cohort', $student->cohort)->count(); // Count quizzes for the student's cohort
        $completedQuizzes = $progressData->where('quiz_id', '!=', null)->count();
        
        $totalAssignments = Assignments::where('cohort', $student->cohort)->count(); // Count assignments for the student's cohort
        $completedAssignments = $progressData->where('assignment_id', '!=', null)->count();
        
        $totalScore = $progressData->sum('score');
        $maxScore = 887; // Define the total score limit
        $percentageProgress = ($totalScore / $maxScore) * 100;

        return view('progress.index', compact('progressData', 'totalQuizzes', 'completedQuizzes', 'totalAssignments', 'completedAssignments', 'totalScore', 'percentageProgress'));
    }

    public function storeQuizProgress(Request $request, $quizId)
    {
        $request->validate([
            'score' => 'required|integer|min:0',
        ]);

        // Check if the progress entry already exists
        $existingProgress = Progress::where('student_id', Auth::id())
            ->where('quiz_id', $quizId)
            ->first();

        if ($existingProgress) {
            // Update existing progress
            $existingProgress->update([
                'score' => $request->score,
                'status' => 'completed',
            ]);
        } else {
            // Create new progress entry
            Progress::create([
                'student_id' => Auth::id(),
                'quiz_id' => $quizId,
                'score' => $request->score,
                'status' => 'completed',
            ]);
        }

        return redirect()->route('progress.index')->with('success', 'Quiz progress recorded successfully.');
    }

    public function storeAssignmentProgress(Request $request, $assignmentId)
    {
        $request->validate([
            'score' => 'required|integer|min:0',
        ]);

        // Check if the progress entry already exists
        $existingProgress = Progress::where('student_id', Auth::id())
            ->where('assignment_id', $assignmentId)
            ->first();

        if ($existingProgress) {
            // Update existing progress
            $existingProgress->update([
                'score' => $request->score,
                'status' => 'completed',
            ]);
        } else {
            // Create new progress entry
            Progress::create([
                'student_id' => Auth::id(),
                'assignment_id' => $assignmentId,
                'score' => $request->score,
                'status' => 'completed',
            ]);
        }

        return redirect()->route('progress.index')->with('success', 'Assignment progress recorded successfully.');
    }
}
