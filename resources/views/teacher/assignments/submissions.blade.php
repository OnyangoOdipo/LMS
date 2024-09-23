<x-teacher-nav>
    <div class="container mx-auto">
        <h2 class="text-2xl font-semibold text-blue-900">Submitted Assignments</h2>

        @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white p-4 rounded-lg shadow mb-4">
            <h3 class="font-semibold">{{ $assignment->title }}</h3>
            <p>{{ $assignment->instructions }}</p>
            <p><strong>Deadline:</strong> {{ $assignment->deadline }}</p>

            <h4 class="mt-4">Submissions</h4>

            @forelse($assignment->submissions as $submission)
            <div class="p-4 bg-gray-100 rounded mb-2">
                <p>Student: {{ $submission->student->name }}</p>
                <p>Submitted on: {{ $submission->created_at }}</p>
                <p>
                    <a href="{{ asset('storage/' . $submission->submission_file) }}" class="text-blue-500" target="_blank">Download Submission</a>
                </p>

                <form action="{{ route('teacher.assignments.grade', $submission->id) }}" method="POST">
                    @csrf
                    <label for="score_{{ $submission->id }}">Score:</label>
                    <input type="number" name="score" id="score_{{ $submission->id }}" class="border p-2" value="{{ $submission->score ?? '' }}" required>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Grade</button>
                </form>
            </div>
            @empty
            <p>No submissions yet.</p>
            @endforelse
        </div>

    </div>
</x-teacher-nav>