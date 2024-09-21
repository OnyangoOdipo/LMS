<x-student-nav>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Available Quizzes</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            @if($quizzes->isEmpty())
                <p class="text-red-500">No quizzes available at the moment.</p>
            @else
                <ul class="space-y-4">
                    @foreach($quizzes as $quiz)
                        <li class="flex justify-between items-center border-b pb-4">
    <div>
        <h2 class="text-xl font-semibold">{{ $quiz->title }}</h2>
        <p class="text-gray-600">Cohort: {{ Auth::user()->cohort }}</p>
        <p class="text-gray-600">Start Time: {{ $quiz->start_time }}</p>
        <p class="text-gray-600">End Time: {{ $quiz->end_time }}</p>

        @php
            $now = \Carbon\Carbon::now();
            $startTime = \Carbon\Carbon::parse($quiz->start_time);
            $diff = $now->diffForHumans($startTime, ['parts' => 3, 'short' => true]); // Adjust for precision
        @endphp

        <p class="text-gray-600">
            @if($now < $startTime)
                Starts in: {{ $diff }}
            @else
                Quiz has started.
            @endif
        </p>
    </div>
    <a href="{{ route('quiz.start', $quiz->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Start Quiz</a>
</li>


                            <!-- JavaScript for Countdown Timer -->
                            <script>
                                const startTime = new Date("{{ $quiz->start_time }}").getTime();
                                const countdownElement = document.getElementById("countdown-{{ $quiz->id }}");

                                const timerInterval = setInterval(() => {
                                    const now = new Date().getTime();
                                    const timeDifference = startTime - now;

                                    if (timeDifference > 0) {
                                        const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                                        const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                                        const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                                        countdownElement.textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                                    } else {
                                        clearInterval(timerInterval);
                                        countdownElement.textContent = "Quiz Started";
                                    }
                                }, 1000);
                            </script>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-student-nav>