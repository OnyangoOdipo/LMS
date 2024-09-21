<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizSubmission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class QuizSubmissionController extends Controller
{
    public function index()
    {
        $userCohort = Auth::user()->cohort;
        $quizzes = Quiz::where('cohort', $userCohort)->with('course')->get();

        return view('quizzes.index', compact('quizzes'));
    }

    public function startQuiz($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $currentTime = Carbon::now();

        if ($currentTime->between($quiz->start_time, $quiz->end_time)) {
            $questions = QuizQuestion::where('quiz_id', $quizId)->get();

            if ($questions->isEmpty()) {
                return redirect()->route('quizzes.index')->with('error', 'No questions available for this quiz.');
            }

            $currentQuestionIndex = 0; // Start with the first question
            $totalQuestions = $questions->count();
            $currentQuestion = $questions[$currentQuestionIndex];

            // Store quiz duration in the session if not already set
            if (!session()->has('quizStartTime')) {
                session(['quizStartTime' => now()]);
                session(['timeRemaining' => $quiz->duration * 60]); // Store the duration in seconds
            }

            return view('quizzes.start', compact('quiz', 'questions', 'currentQuestionIndex', 'totalQuestions', 'currentQuestion'));
        } else {
            return redirect()->route('dashboard')->with('error', 'The quiz is not available at this time.');
        }
    }

    public function submitQuestion(Request $request, $quizId, $questionId)
{
    $quiz = Quiz::findOrFail($quizId);
    $request->validate(['answer' => 'required']);

    $submission = QuizSubmission::firstOrCreate(
        [
            'quiz_id' => $quizId,
            'student_id' => Auth::id(),
        ],
        [
            'answers' => json_encode([]), // Initialize answers as an empty JSON array if it doesn't exist
        ]
    );

    $answers = json_decode($submission->answers, true) ?? [];
    $answers[$questionId] = $request->input('answer'); // Store the selected answer

    $submission->answers = json_encode($answers);
    $submission->save(); // Save to the database

    // Calculate the remaining time
    $quizStartTime = session('quizStartTime');
    $elapsedTime = now()->diffInSeconds($quizStartTime); // Calculate time since quiz started
    $timeRemaining = session('timeRemaining') - $elapsedTime;

    if ($timeRemaining <= 0) {
        // Time's up, submit the quiz
        return redirect()->route('quiz.submit', $quizId);
    }

    // Store updated remaining time in session
    session(['timeRemaining' => $timeRemaining]);

    // Get the next question or submit the quiz
    $nextQuestion = QuizQuestion::where('quiz_id', $quizId)
        ->where('id', '>', $questionId)
        ->first();

    if ($nextQuestion) {
        return redirect()->route('quizzes.question', [$quizId, $nextQuestion->id]);
    } else {
        return redirect()->route('quiz.submit', $quizId);
    }
}

public function showQuestion($quizId, $questionId)
{
    $quiz = Quiz::findOrFail($quizId);
    $questions = QuizQuestion::where('quiz_id', $quizId)->get();
    $currentQuestion = $questions->firstWhere('id', $questionId);

    $totalQuestions = $questions->count();
    $currentQuestionIndex = $questions->search($currentQuestion);

    // Ensure quiz start time and remaining time are available in the session
    if (!session()->has('quizStartTime')) {
        return redirect()->route('quizzes.start', $quizId)->with('error', 'Quiz session not initialized.');
    }

    $quizStartTime = session('quizStartTime');
    $quizDuration = session('timeRemaining', $quiz->duration); // Retrieve from session or default to quiz duration
    $elapsedTime = now()->diffInSeconds($quizStartTime);

    $timeRemaining = $quizDuration - $elapsedTime;

    // If time is up, submit the quiz
    if ($timeRemaining <= 0) {
        return redirect()->route('quiz.submit', $quizId);
    }

    // Store updated remaining time in session
    session(['timeRemaining' => $timeRemaining]);

    return view('quizzes.start', compact('quiz', 'questions', 'currentQuestion', 'totalQuestions', 'currentQuestionIndex', 'timeRemaining'));
}

public function submitQuiz($quizId)
{
    $submission = QuizSubmission::where('quiz_id', $quizId)
        ->where('student_id', Auth::id())
        ->first();

    if (!$submission || !$submission->answers) {
        return redirect()->back()->withErrors('Submission not found or answers missing.');
    }

    $answers = json_decode($submission->answers, true);

    $score = 0;
    $questions = QuizQuestion::where('quiz_id', $quizId)->get();

    foreach ($questions as $question) {
        $choices = json_decode($question->options, true);
        $correctAnswer = collect($choices)->firstWhere('is_correct', true);

        if (isset($answers[$question->id]) && $answers[$question->id] == $correctAnswer['choice']) {
            $score++;
        }
    }

    $submission->score = $score;
    $submission->is_graded = 1;
    $submission->save();

    // Clear session data related to the quiz
    session()->forget(['quizStartTime', 'timeRemaining']);

    return redirect()->route('quiz.results', ['quizId' => $quizId]);
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
        $totalQuestions = $quizQuestions->count();

        return view('quizzes.results', [
            'quiz' => Quiz::find($quizId),
            'quizQuestions' => $quizQuestions,
            'answers' => $answers,
            'score' => $score,
            'totalQuestions' => $totalQuestions,
        ]);
    }
}
