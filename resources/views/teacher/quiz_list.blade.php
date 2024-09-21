<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz List</title>
</head>
<body>
    <h1>List of Quizzes</h1>

    <a href="{{ route('quizzes.create') }}">Create New Quiz</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Course</th>
                <th>Type</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quizzes as $quiz)
                <tr>
                    <td>{{ $quiz->title }}</td>
                    <td>{{ $quiz->course->name }}</td>
                    <td>{{ $quiz->quiz_type }}</td>
                    <td>{{ $quiz->start_time }}</td>
                    <td>{{ $quiz->end_time }}</td>
                    <td>
                        <a href="{{ route('quizzes.edit', $quiz->id) }}">Edit</a>
                        <a href="{{ route('quizzes.details', $quiz->id) }}">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
