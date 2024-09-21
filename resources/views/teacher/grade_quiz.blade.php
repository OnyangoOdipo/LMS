@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Grade Quiz Submission</h1>
    <form action="{{ route('teacher.grade', $submission->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label>Score (out of 100):</label>
            <input type="number" name="score" min="0" max="100" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Submit Grade</button>
    </form>
</div>
@endsection
