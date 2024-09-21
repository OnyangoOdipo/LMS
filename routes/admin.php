<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/courses', [CourseController::class, 'index'])->name('courses'); // Display courses
        Route::post('/courses', [CourseController::class, 'store'])->name('courses.store'); // Create course
        Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit'); // Fetch data for edit
        Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update'); // Update course
        Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy'); // Delete course

        Route::get('/users', [UserController::class, 'showStudents'])->name('users');
        Route::get('/teachers', [UserController::class, 'showTeachers'])->name('teachers');
        Route::delete('/users/{id}', [UserController::class, 'deleteStudent'])->name('delete.user');
        Route::delete('/teachers/{id}', [UserController::class, 'deleteTeacher'])->name('delete.teacher');
        Route::post('/teachers', [UserController::class, 'storeTeacher'])->name('store.teacher');


        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });
});
