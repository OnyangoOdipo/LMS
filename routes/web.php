<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizSubmissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/socialite/{driver}', [SocialLoginController::class, 'toProvider'])->where('driver', 'google|github');
Route::get('/auth/{driver}login', [SocialLoginController::class, 'handleCallback'])->where('driver', 'google|github');

Route::get('/video-call-room', function () {
    return view('video-call-room');
})->name('video-call-room');

Route::get('/video', function () {
    return view('video');
})->name('video');

Route::get('/quizzes', [QuizSubmissionController::class, 'index'])->name('quizzes.index');
Route::get('quiz/{quizId}/start', [QuizSubmissionController::class, 'startQuiz'])->name('quiz.start');
Route::get('quizzes/{quizId}/questions/{questionId}', [QuizSubmissionController::class, 'startQuiz'])->name('quizzes.question');
Route::get('/quiz/{quizId}/questions/{questionId}', [QuizSubmissionController::class, 'showQuestion'])->name('quizzes.question');
Route::post('quiz/{quizId}/question/{questionId}/submit', [QuizSubmissionController::class, 'submitQuestion'])->name('quizzes.submitQuestion');
Route::get('quiz/{quizId}/submit', [QuizSubmissionController::class, 'submitQuiz'])->name('quiz.submit');
Route::get('quiz/{quizId}/results', [QuizSubmissionController::class, 'showResults'])->name('quiz.results');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/teacher.php';
