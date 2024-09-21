<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz</title>
</head>
<body>
    <h1>Create a New Quiz</h1>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" required>
        <br>

        <label for="course_id">Course ID:</label>
        <input type="number" name="course_id" id="course_id" value="{{ old('course_id') }}" required>
        <br>

        <label for="quiz_type">Quiz Type:</label>
        <select name="quiz_type" id="quiz_type" required>
            <option value="multiple_choice" {{ old('quiz_type') == 'multiple_choice' ? 'selected' : '' }}>Multiple Choice</option>
            <option value="teacher_reviewed" {{ old('quiz_type') == 'teacher_reviewed' ? 'selected' : '' }}>Teacher Reviewed</option>
        </select>
        <br>

        <label for="cohort">Cohort:</label>
        <input type="number" name="cohort" id="cohort" value="{{ old('cohort') }}" required>
        <br>

        <label for="start_time">Start Time:</label>
        <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
        <br>

        <label for="end_time">End Time:</label>
        <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" required>
        <br>

        <label for="duration">Duration (minutes):</label>
        <input type="number" name="duration" id="duration" value="{{ old('duration') }}">
        <br>

        <button type="submit">Create Quiz</button>
    </form>
</body>
</html>
