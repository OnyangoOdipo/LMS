<x-student-nav>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">{{ $quiz->title }}</h1>

        <div id="quiz-timer" class="bg-red-100 p-4 rounded-lg mb-4">
            Time Remaining: <span id="timer"></span>
        </div>

        <div class="bg-white shadow-lg p-6 rounded-lg">
            @if($currentQuestion)
                <h2 class="text-xl font-semibold">{{ $currentQuestion->question }}</h2>

                <form action="{{ route('quizzes.submitQuestion', [$quiz->id, $currentQuestion->id]) }}" method="POST">
                    @csrf

                    <div class="mt-4 space-y-2">
                        @foreach (json_decode($currentQuestion->options) as $option)
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="answer" value="{{ $option->choice }}" class="form-radio" required>
                                    <span class="ml-2">{{ $option->choice }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 flex justify-between">
                        @if ($currentQuestionIndex < $totalQuestions - 1)
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Next</button>
                        @else
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Submit Quiz</button>
                        @endif
                    </div>
                </form>
            @else
                <p class="text-red-500">No question available.</p>
            @endif
        </div>

        <div class="flex justify-between items-center mt-8">
            <p>Question {{ $currentQuestionIndex + 1 }} of {{ $totalQuestions }}</p>
        </div>
    </div>

    <script>
    let remainingTime = {{ $remainingTime }};
    let timerInterval = setInterval(function() {
        if (remainingTime <= 0) {
            clearInterval(timerInterval);
            document.getElementById('quiz-form').submit(); // auto-submit when time is up
        } else {
            let minutes = Math.floor(remainingTime / 60);
            let seconds = remainingTime % 60;
            document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');
            remainingTime--;
        }
    }, 1000);
</script>

</x-student-nav>