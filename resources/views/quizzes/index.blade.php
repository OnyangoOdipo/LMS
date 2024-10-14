<x-student-nav>
<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold mb-8">Available Quizzes</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($quizzes as $quiz)
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold">{{ $quiz->title }}</h2>
                <p class="text-gray-600 mt-2">{{ $quiz->description }}</p>
                <p class="text-sm text-gray-500 mt-1">Duration: {{ $quiz->duration }} minutes</p>
                <p class="text-sm text-gray-500">Start: {{ $quiz->start_time->format('Y-m-d H:i') }}</p>
                <p class="text-sm text-gray-500">End: {{ $quiz->end_time->format('Y-m-d H:i') }}</p>

                @php
                    $currentDateTime = now();
                    $startTime = $quiz->start_time;
                    $endTime = $quiz->end_time;
                    $hasSubmission = $quiz->submissions()->where('student_id', Auth::id())->exists();
                @endphp

                @if ($hasSubmission)
                    <button class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded-lg cursor-not-allowed" disabled>
                        Completed
                    </button>
                @elseif ($currentDateTime < $startTime)
                    <p class="text-yellow-500 mt-2">The quiz will be available on {{ $startTime->format('Y-m-d H:i') }}</p>
                @elseif ($currentDateTime > $endTime)
                    <button class="mt-4 inline-block bg-red-500 text-white px-4 py-2 rounded-lg cursor-not-allowed" disabled>
                        Missed
                    </button>
                @else
                    <a href="{{ route('quizzes.show', $quiz->id) }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Attempt
                    </a>
                @endif
            </div>
        @endforeach
    </div>
</div>
</x-student-nav>
