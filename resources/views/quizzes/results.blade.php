<x-student-nav>
<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold mb-8">Quiz Results: {{ $quiz->title }}</h1>
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold">Your Score: {{ $score }} / {{ $totalQuestions }}</h2>

        <div class="mt-6 space-y-4">
            @foreach ($quizQuestions as $question)
                <div class="p-4 bg-gray-100 rounded-lg">
                    <h3 class="font-semibold">{{ $question->question_text }}</h3>
                    <p class="mt-2 text-sm">
                        <strong>Your Answer:</strong> {{ $answers[$question->id] ?? 'No Answer' }}
                    </p>
                    <p class="text-sm text-green-600">
                        <strong>Correct Answer:</strong> {{ collect(json_decode($question->options, true))->firstWhere('is_correct', true)['choice'] }}
                    </p>
                </div>
            @endforeach
        </div>

        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">AI Analysis</h2>
            <p class="mb-4">{{ $aiAnalysis['overview'] }}</p>
            <h3 class="text-xl font-semibold mb-2">Improvement Areas:</h3>
            <ul class="list-disc pl-5">
                @foreach($aiAnalysis['improvementAreas'] as $area)
                    <li>{{ $area }}</li>
                @endforeach
            </ul>
            <h3 class="text-xl font-semibold mt-4 mb-2">Recommended Resources:</h3>
            <ul class="list-disc pl-5">
                @foreach($aiAnalysis['recommendedResources'] as $resource)
                    <li><a href="{{ $resource['url'] }}" class="text-blue-500 hover:underline">{{ $resource['title'] }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <a href="{{ route('quizzes.index') }}" class="mt-8 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg">
        Back to Quizzes
    </a>
</div>
</x-student-nav>
