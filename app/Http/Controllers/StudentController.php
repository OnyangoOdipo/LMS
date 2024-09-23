<?php

namespace App\Http\Controllers;

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
                $quiz->due_in_days = now()->diffInDays($quiz->end_time); // Calculate days until end_time
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

        return view('dashboard', compact('quizzes', 'assignments', 'announcements'));
    }
}
