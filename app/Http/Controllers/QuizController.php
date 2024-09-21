<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Course;
use App\Models\QuizQuestion;
use App\Models\QuizChoice;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('course')->get(); // Load quizzes with associated courses
        return view('teacher.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('teacher.quizzes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'quiz_type' => 'required|in:multiple_choice,teacher_reviewed',
            'cohort' => 'required|integer',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'duration' => 'nullable|integer',
            'questions' => 'required_if:quiz_type,multiple_choice|array',
            'questions.*.question' => 'required|string',
            'questions.*.choices' => 'required|array',
            'questions.*.choices.*.choice' => 'required|string',
            'questions.*.choices.*.is_correct' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $quiz = Quiz::create([
            'title' => $request->input('title'),
            'course_id' => $request->input('course_id'),
            'quiz_type' => $request->input('quiz_type'),
            'cohort' => $request->input('cohort'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'duration' => $request->input('duration'),
        ]);

        if ($request->input('quiz_type') === 'multiple_choice') {
            foreach ($request->input('questions') as $questionData) {
                $question = QuizQuestion::create([
                    'quiz_id' => $quiz->id,
                    'question' => $questionData['question'],
                    'options' => json_encode($questionData['choices']),
                ]);

                foreach ($questionData['choices'] as $choiceData) {
                    QuizChoice::create([
                        'quiz_question_id' => $question->id,
                        'choice' => $choiceData['choice'],
                        'is_correct' => $choiceData['is_correct'] ?? false,
                    ]);
                }
            }
        }

        return redirect()->route('teacher.quizzes.index')->with('success', 'Quiz created successfully with questions and choices');
    }

    public function edit($id)
    {
        $quiz = Quiz::with(['questions.choices'])->findOrFail($id);
        $courses = Course::all();

        return view('teacher.quizzes.edit', compact('quiz', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'quiz_type' => 'required|in:multiple_choice,teacher_reviewed',
            'cohort' => 'required|integer',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'duration' => 'nullable|integer',
            'questions' => 'required_if:quiz_type,multiple_choice|array',
            'questions.*.question' => 'required|string',
            'questions.*.choices' => 'required|array',
            'questions.*.choices.*.choice' => 'required|string',
            'questions.*.choices.*.is_correct' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $quiz = Quiz::findOrFail($id);
        $quiz->update([
            'title' => $request->input('title'),
            'course_id' => $request->input('course_id'),
            'quiz_type' => $request->input('quiz_type'),
            'cohort' => $request->input('cohort'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'duration' => $request->input('duration'),
        ]);

        // Update questions and choices
        foreach ($request->input('questions') as $questionData) {
            // Update or create the question
            $question = QuizQuestion::updateOrCreate(
                ['id' => $questionData['id'] ?? null, 'quiz_id' => $quiz->id],
                ['question' => $questionData['question']]
            );

            // Update or create choices
            foreach ($questionData['choices'] as $choiceData) {
                QuizChoice::updateOrCreate(
                    ['id' => $choiceData['id'] ?? null, 'quiz_question_id' => $question->id],
                    ['choice' => $choiceData['choice'], 'is_correct' => $choiceData['is_correct'] ?? false]
                );
            }
        }

        return redirect()->route('teacher.quizzes.index')->with('success', 'Quiz updated successfully!');
    }

}
