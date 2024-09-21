<?php

use App\Http\Controllers\Teacher\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Teacher\ProfileController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::middleware('guest:teacher')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);
    });

    Route::get('/video-call-room', function() {
        return view('video-call-room');
    })->name('video-call-room');
    
    Route::get('/video', function() {
        return view('video');
    })->name('video');
    

    Route::middleware('auth:teacher')->group(function () {
        Route::get('/dashboard', function () {
            return view('teacher.dashboard');
        })->name('dashboard');

            Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
            Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
            Route::post('/', [QuizController::class, 'store'])->name('quizzes.store');
            Route::get('/quizzes/{quiz}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');
            Route::put('/quizzes/{quiz}', [QuizController::class, 'update'])->name('quizzes.update');
            Route::delete('/quizzes/{quiz}', [QuizController::class, 'destroy'])->name('quizzes.destroy');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });
});
