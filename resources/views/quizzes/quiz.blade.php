<x-student-nav>
<div class="container mx-auto p-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">{{ $quiz->title }}</h1>
        <div id="timer" class="text-2xl font-semibold text-red-600"></div>
    </div>
    
    <p class="text-gray-600 mb-6">
        Cohort: {{ $quiz->cohort }} <br>
        Duration: {{ $quiz->duration }} minutes <br>
        Ends on: {{ $quiz->end_time->format('Y-m-d H:i') }} (Kenyan Time)
    </p>

    <form id="quizForm" method="POST" action="{{ route('quizzes.submit', $quiz->id) }}" class="space-y-6">
        @csrf
        @foreach ($quiz->questions as $index => $question)
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold">{{ $index + 1 }}. {{ $question->question }}</h2>
                <div class="mt-4 space-y-2">
                    @foreach (json_decode($question->options, true) as $option)
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option['choice'] }}" class="form-radio text-blue-500" required>
                            <span class="text-gray-700">{{ $option['choice'] }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach

        <button type="submit" id="submitButton" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg mt-6">
            Submit Quiz
        </button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quizId = "{{ $quiz->id }}";
        const quizDuration = "{{ $quiz->duration * 60 }}"; // Convert minutes to seconds
        const quizEndTime = new Date("{{ $quiz->end_time->toIso8601String() }}");
        const serverNow = new Date("{{ now()->setTimezone('Africa/Nairobi')->toIso8601String() }}");

        let startTime = localStorage.getItem(`quiz_${quizId}_start_time`);
        if (!startTime) {
            startTime = new Date().getTime();
            localStorage.setItem(`quiz_${quizId}_start_time`, startTime);
        } else {
            startTime = parseInt(startTime);
        }

        const quizForm = document.getElementById('quizForm');
        const submitButton = document.getElementById('submitButton');

        function getTimeLeft() {
            const now = new Date().getTime();
            const elapsed = Math.floor((now - startTime) / 1000);
            return Math.max(0, Math.min(quizDuration - elapsed, Math.floor((quizEndTime - now) / 1000)));
        }

        function updateTimer() {
            const timeLeft = getTimeLeft();
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            document.getElementById('timer').textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                submitQuiz();
            }
        }

        async function submitQuiz() {
            // Disable all form inputs and the submit button
            Array.from(quizForm.elements).forEach(element => element.disabled = true);
            submitButton.textContent = 'Submitting...';
            submitButton.classList.add('bg-gray-500', 'cursor-not-allowed');
            submitButton.classList.remove('bg-green-500', 'hover:bg-green-600');

            try {
                const formData = new FormData(quizForm);
                const response = await axios.post(quizForm.action, formData);
                
                if (response.data.redirect) {
                    window.location.href = response.data.redirect;
                } else {
                    console.error('Unexpected response:', response);
                }
            } catch (error) {
                console.error('Error submitting quiz:', error);
                if (error.response && error.response.status === 419) {
                    // CSRF token mismatch, refresh the token and try again
                    await refreshCsrfToken();
                    submitQuiz();
                } else {
                    alert('An error occurred while submitting the quiz. Please try again.');
                    // Re-enable form elements
                    Array.from(quizForm.elements).forEach(element => element.disabled = false);
                    submitButton.textContent = 'Submit Quiz';
                    submitButton.classList.remove('bg-gray-500', 'cursor-not-allowed');
                    submitButton.classList.add('bg-green-500', 'hover:bg-green-600');
                }
            }
        }

        async function refreshCsrfToken() {
            try {
                const response = await axios.get('/csrf-token');
                document.querySelector('input[name="_token"]').value = response.data.csrf_token;
            } catch (error) {
                console.error('Error refreshing CSRF token:', error);
            }
        }

        const timerInterval = setInterval(updateTimer, 1000);

        // Update timer immediately
        updateTimer();

        // Handle form submission
        quizForm.addEventListener('submit', function(e) {
            e.preventDefault();
            submitQuiz();
        });

        // Warn the user if they try to leave the page
        window.addEventListener('beforeunload', function (e) {
            const timeLeft = getTimeLeft();
            if (timeLeft > 0) {
                e.preventDefault();
                e.returnValue = '';
            }
        });

        // Submit form when time is up
        setTimeout(submitQuiz, getTimeLeft() * 1000);
    });
</script>
</x-student-nav>
