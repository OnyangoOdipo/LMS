<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showStudents()
    {
        $students = User::all(); // Fetch all users from the users table
        return view('admin.users', compact('students'));
    }

    // Show the teachers page
    public function showTeachers()
    {
        $teachers = Teacher::all(); // Fetch all teachers from the teachers table
        return view('admin.teachers', compact('teachers'));
    }

    public function storeStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        // Store new teacher with default password
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('student#123'), // Default password
            'cohort' => '2',
        ]);

        return redirect()->route('admin.users')->with('success', 'Teacher added successfully.');
    }

    public function storeTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers',
        ]);

        // Store new teacher with default password
        Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('teacher#123'), // Default password
        ]);

        return redirect()->route('admin.teachers')->with('success', 'Teacher added successfully.');
    }

    public function destroyUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
        }
        return redirect()->route('admin.users')->with('error', 'User not found.');
    }

    public function destroyTeacher($id)
    {
        $teacher = Teacher::find($id);
        if ($teacher) {
            $teacher->delete();
            return redirect()->route('admin.teachers')->with('success', 'Teacher deleted successfully.');
        }
        return redirect()->route('admin.teachers')->with('error', 'Teacher not found.');
    }
}
