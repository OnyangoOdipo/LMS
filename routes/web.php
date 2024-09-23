<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizSubmissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard'); // Student dashboard

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

Route::get('/quizzes', [QuizSubmissionController::class, 'index'])->name('quizzes.index'); // List all quizzes
Route::get('/quizzes/{quizId}', [QuizSubmissionController::class, 'showQuiz'])->name('quizzes.show');
Route::post('/quizzes/{quizId}/submit', [QuizSubmissionController::class, 'submitQuiz'])->name('quizzes.submit');
Route::get('/quizzes/{quizId}/results', [QuizSubmissionController::class, 'showResults'])->name('quizzes.results');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/teacher.php';
