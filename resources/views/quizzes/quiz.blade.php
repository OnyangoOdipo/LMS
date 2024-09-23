<x-student-nav>
<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold mb-8">{{ $quiz->title }}</h1>
    
    <form method="POST" action="{{ route('quizzes.submit', $quiz->id) }}" class="space-y-6">
        @csrf
        @foreach ($quiz->questions as $index => $question)
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold">{{ $index + 1 }}. {{ $question->question_text }}</h2>
                <div class="mt-4 space-y-2">
                    @foreach (json_decode($question->options, true) as $option)
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option['choice'] }}" class="form-radio text-blue-500">
                            <span class="text-gray-700">{{ $option['choice'] }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg mt-6">
            Submit Quiz
        </button>
    </form>
</div>
</x-student-nav>
