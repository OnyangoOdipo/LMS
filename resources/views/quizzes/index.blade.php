<x-student-nav>
<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold mb-8">Available Quizzes</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($quizzes as $quiz)
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold">{{ $quiz->title }}</h2>
                <p class="text-gray-600 mt-2">{{ $quiz->description }}</p>
                <p class="text-sm text-gray-500 mt-1">Duration: {{ $quiz->duration }} minutes</p>
                <a href="{{ route('quizzes.show', $quiz->id) }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg">
                    Start Quiz
                </a>
            </div>
        @endforeach
    </div>
</div>
</x-student-nav>
