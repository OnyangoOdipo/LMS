<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">{{ $quiz->title }} - Results</h1>

    <p class="text-xl mb-4">Your Score: {{ $score }} / {{ $totalQuestions }}</p>

    <div class="space-y-6">
        @foreach ($quizQuestions as $question)
            <div class="bg-white shadow-lg p-6 rounded-lg">
                <h2 class="text-xl font-semibold">{{ $question->question }}</h2>
                <div class="mt-4 space-y-2">
                    @foreach (json_decode($question->options) as $key => $option)
                        <div class="p-2 {{ $question->correct_choice == $key ? 'bg-green-100' : '' }}">
                            <strong>{{ $key + 1 }}.</strong> {{ $option->choice }}
                            @if (isset($answers[$question->id]) && $answers[$question->id] == $key)
                                <span class="{{ $answers[$question->id] == $question->correct_choice ? 'text-green-500' : 'text-red-500' }}">
                                    (Your Answer: {{ $option->choice }})
                                </span>
                            @endif
                            @if ($question->correct_choice == $key)
                                <span class="text-green-500">(Correct)</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        <a href="{{ route('quizzes.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
            Back to Quizzes
        </a>
    </div>
</div>
