<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Progress;
use App\Models\QuizQuestion;
use App\Models\QuizSubmission;
use Illuminate\Support\Facades\Auth;

class QuizSubmissionController extends Controller
{
    public function index()
    {
        $userCohort = Auth::user()->cohort;
        $quizzes = Quiz::where('cohort', $userCohort)->with('course')->get();

        return view('quizzes.index', compact('quizzes'));
    }

    public function showQuiz($quizId)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);

        $currentDateTime = now();

        // Check if the quiz is accessible
        if ($currentDateTime < $quiz->start_time) {
            return redirect()->back()->withErrors('The quiz has not started yet. It will be available on ' . $quiz->start_time->format('Y-m-d H:i'));
        }

        if ($currentDateTime > $quiz->end_time) {
            return redirect()->back()->withErrors('The quiz has already ended. It was available until ' . $quiz->end_time->format('Y-m-d H:i'));
        }

        return view('quizzes.quiz', compact('quiz'));
    }

    public function submitQuiz(Request $request, $quizId)
    {
        $request->validate(['answers' => 'required|array']);

        // Create or update the quiz submission
        $submission = QuizSubmission::firstOrCreate(
            ['quiz_id' => $quizId, 'student_id' => Auth::id()],
            ['answers' => json_encode([])]
        );

        $submission->answers = json_encode($request->input('answers'));
        $submission->score = $this->calculateScore($quizId, $submission->answers);
        $submission->is_graded = 1;
        $submission->save();

        // Update the progress table
        $this->updateProgress($quizId, $submission->score);

        return redirect()->route('quizzes.results', ['quizId' => $quizId]);
    }

    private function updateProgress($quizId, $score)
    {
        // Check if progress entry already exists
        $existingProgress = Progress::where('student_id', Auth::id())
            ->where('quiz_id', $quizId)
            ->first();

        if ($existingProgress) {
            // Update existing progress
            $existingProgress->update([
                'score' => $score,
                'status' => 'completed',
            ]);
        } else {
            // Create new progress entry
            Progress::create([
                'student_id' => Auth::id(),
                'quiz_id' => $quizId,
                'score' => $score,
                'status' => 'completed',
            ]);
        }
    }

    private function calculateScore($quizId, $answers)
    {
        $score = 0;
        $answers = json_decode($answers, true);
        $questions = QuizQuestion::where('quiz_id', $quizId)->get();

        foreach ($questions as $question) {
            $choices = json_decode($question->options, true);
            $correctAnswer = collect($choices)->firstWhere('is_correct', true);

            if (isset($answers[$question->id]) && $answers[$question->id] == $correctAnswer['choice']) {
                $score++;
            }
        }

        return $score;
    }

    public function showResults($quizId)
    {
        $submission = QuizSubmission::where('quiz_id', $quizId)
            ->where('student_id', Auth::id())
            ->first();

        if (!$submission) {
            return redirect()->back()->withErrors('Submission not found.');
        }

        $answers = json_decode($submission->answers, true);
        $quizQuestions = QuizQuestion::where('quiz_id', $quizId)->get();
        $score = $submission->score;
        $totalQuestions = $quizQuestions->count(); // This is important

        return view('quizzes.results', [
            'quiz' => Quiz::find($quizId),
            'quizQuestions' => $quizQuestions,
            'answers' => $answers,
            'score' => $score,
            'totalQuestions' => $totalQuestions, // Make sure this is passed
        ]);
    }
}
