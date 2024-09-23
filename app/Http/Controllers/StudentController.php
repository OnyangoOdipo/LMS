<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Quiz;
use App\Models\Announcement;
use App\Models\Assignments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
{
    $student = Auth::user();

    // Fetch quizzes
    $quizzes = Quiz::where('cohort', $student->cohort)
        ->where('start_time', '>', now())
        ->orderBy('start_time')
        ->get()
        ->map(function ($quiz) {
            $quiz->due_in_days = now()->diffInDays($quiz->end_time);
            return $quiz;
        });

    // Fetch assignments
    $assignments = Assignments::where('cohort', $student->cohort)
        ->where('deadline', '>', now())
        ->orderBy('deadline')
        ->get()
        ->map(function ($assignment) {
            $assignment->due_in_days = now()->diffInDays($assignment->deadline);
            return $assignment;
        });

    // Fetch announcements
    $announcements = Announcement::where('recipient_type', 'everyone')
        ->orWhere('recipient_type', $student->cohort)
        ->latest()
        ->get();

    // Calculate progress statistics
    $progressData = Progress::where('student_id', $student->id)->get();

    $totalQuizzes = $quizzes->count();
    $completedQuizzes = $progressData->where('quiz_id', '!=', null)->count();
    
    $totalAssignments = $assignments->count();
    $completedAssignments = $progressData->where('assignment_id', '!=', null)->count();
    
    $totalScore = $progressData->sum('score');
    $maxScore = 887;
    $percentageProgress = ($totalScore / $maxScore) * 100;

    // Include announcements in the view
    return view('dashboard', compact('quizzes', 'assignments', 'announcements', 'totalQuizzes', 'completedQuizzes', 'totalAssignments', 'completedAssignments', 'totalScore', 'percentageProgress'));
}

}
