<x-student-nav>
<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold mb-8">Available Quizzes</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($quizzes as $quiz)
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold">{{ $quiz->title }}</h2>
                <p class="text-gray-600 mt-2">{{ $quiz->description }}</p>
                <p class="text-sm text-gray-500 mt-1">Duration: {{ $quiz->duration }} minutes</p>

                @php
                    $currentDateTime = now();
                    $startTime = \Carbon\Carbon::parse($quiz->start_time);
                    $endTime = \Carbon\Carbon::parse($quiz->end_time);
                @endphp

                @if ($currentDateTime < $startTime)
                    <p class="text-red-500 mt-2">The quiz will be available on {{ $startTime->format('Y-m-d H:i') }}</p>
                @elseif ($currentDateTime > $endTime)
                    <p class="text-red-500 mt-2">The quiz has already ended. It was available until {{ $endTime->format('Y-m-d H:i') }}</p>
                @else
                    <a href="{{ route('quizzes.show', $quiz->id) }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg">
                        Start Quiz
                    </a>
                @endif
            </div>
        @endforeach
    </div>
</div>
</x-student-nav>
