<x-student-nav>
<h1>{{ $assignment->title }}</h1>
<p>{{ $assignment->instructions }}</p>
<p>Deadline: {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M Y') }}</p>

<h2>Submit Assignment</h2>
<form action="{{ route('assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="submission_file">Upload Submission</label>
        <input type="file" name="submission_file" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<h2>Your Score</h2>
@if ($assignment->submissions)
    <p>Your score: {{ $assignment->submissions->score ?? 'Not graded yet' }}</p>
@endif
</x-student-nav>
