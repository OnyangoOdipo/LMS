<x-teacher-nav>
    <style>
        .hidden {
            display: none;
        }
    </style>
    <script>
        function toggleQuestions() {
            var quizType = document.getElementById('quiz_type').value;
            var questionsSection = document.getElementById('questions_section');
            questionsSection.classList.toggle('hidden', quizType !== 'multiple_choice');
        }

        function addQuestion() {
            var questionsContainer = document.getElementById('questions_container');
            var questionIndex = questionsContainer.children.length;
            var questionDiv = document.createElement('div');

            questionDiv.innerHTML = `
                <label>Question ${questionIndex + 1}:</label>
                <input type="text" name="questions[${questionIndex}][question]" required class="border dark:border-gray-600 rounded p-2 w-full mb-2 dark:bg-gray-700 dark:text-gray-200">
                <div>
                    <label>Choices:</label>
                    <div id="choices_container_${questionIndex}"></div>
                    <button type="button" onclick="addChoice(${questionIndex})" class="mt-2 bg-blue-500 text-white p-2 rounded">Add Choice</button>
                </div>
            `;
            questionsContainer.appendChild(questionDiv);
        }

        function addChoice(questionIndex) {
            var choicesContainer = document.getElementById(`choices_container_${questionIndex}`);
            var choiceIndex = choicesContainer.children.length;

            var choiceDiv = document.createElement('div');
            choiceDiv.innerHTML = `
                <input type="text" name="questions[${questionIndex}][choices][${choiceIndex}][choice]" required class="border dark:border-gray-600 rounded p-2 mb-1 dark:bg-gray-700 dark:text-gray-200">
                <label>Correct</label>
                <input type="checkbox" name="questions[${questionIndex}][choices][${choiceIndex}][is_correct]" value="1">
            `;
            choicesContainer.appendChild(choiceDiv);
        }
    </script>

    <body <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex-1 mt-4">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Edit Quiz: {{ $quiz->title }}</h1>

            @if($errors->any())
            <ul class="text-red-500 dark:text-red-300">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            <form action="{{ route('teacher.quizzes.update', $quiz->id) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                @csrf
                @method('PUT')

                <label for="title" class="block mb-2">Title:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $quiz->title) }}" required class="border dark:border-gray-600 rounded p-2 w-full mb-4 dark:bg-gray-700 dark:text-gray-200">

                <label for="course_id" class="block mb-2">Course:</label>
                <select name="course_id" id="course_id" required class="border dark:border-gray-600 rounded p-2 w-full mb-4 dark:bg-gray-700 dark:text-gray-200">
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $quiz->course_id == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                    @endforeach
                </select>

                <label for="quiz_type" class="block mb-2">Quiz Type:</label>
                <select name="quiz_type" id="quiz_type" onchange="toggleQuestions()" required class="border dark:border-gray-600 rounded p-2 w-full mb-4 dark:bg-gray-700 dark:text-gray-200">
                    <option value="multiple_choice" {{ $quiz->quiz_type == 'multiple_choice' ? 'selected' : '' }}>Multiple Choice</option>
                    <option value="teacher_reviewed" {{ $quiz->quiz_type == 'teacher_reviewed' ? 'selected' : '' }}>Teacher Reviewed</option>
                </select>

                <label for="cohort" class="block mb-2">Cohort:</label>
                <input type="number" name="cohort" id="cohort" value="{{ old('cohort', $quiz->cohort) }}" required class="border dark:border-gray-600 rounded p-2 w-full mb-4 dark:bg-gray-700 dark:text-gray-200">

                <label for="start_time" class="block mb-2">Start Time:</label>
                <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $quiz->start_time) }}" required class="border dark:border-gray-600 rounded p-2 w-full mb-4 dark:bg-gray-700 dark:text-gray-200">

                <label for="end_time" class="block mb-2">End Time:</label>
                <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $quiz->end_time) }}" required class="border dark:border-gray-600 rounded p-2 w-full mb-4 dark:bg-gray-700 dark:text-gray-200">

                <label for="duration" class="block mb-2">Duration (minutes):</label>
                <input type="number" name="duration" id="duration" value="{{ old('duration', $quiz->duration) }}" class="border dark:border-gray-600 rounded p-2 w-full mb-4 dark:bg-gray-700 dark:text-gray-200">

                <div id="questions_section" class="{{ $quiz->quiz_type !== 'multiple_choice' ? 'hidden' : '' }}">
                    <h3 class="text-lg font-semibold mt-4">Questions</h3>
                    <div id="questions_container">
                        @foreach ($quiz->questions as $index => $question)
                        <div class="mb-4">
                            <label>Question {{ $index + 1 }}:</label>
                            <input type="text" name="questions[{{ $index }}][question]" value="{{ $question->question }}" required class="border dark:border-gray-600 rounded p-2 w-full mb-2 dark:bg-gray-700 dark:text-gray-200">
                            <div>
                                <label>Choices:</label>
                                <div id="choices_container_{{ $index }}">
                                    @foreach (json_decode($question->options, true) as $choiceIndex => $choice)
                                    <div>
                                        <input type="text" name="questions[{{ $index }}][choices][{{ $choiceIndex }}][choice]" value="{{ $choice['choice'] }}" required class="border dark:border-gray-600 rounded p-2 mb-1 dark:bg-gray-700 dark:text-gray-200">
                                        <label>Correct</label>
                                        <input type="checkbox" name="questions[{{ $index }}][choices][{{ $choiceIndex }}][is_correct]" value="1"
                                            {{ isset($choice['is_correct']) && $choice['is_correct'] ? 'checked' : '' }}>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" onclick="addChoice({{ $index }})" class="mt-2 bg-blue-500 text-white p-2 rounded">Add Choice</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addQuestion()" class="mt-4 bg-green-500 text-white p-2 rounded">Add Question</button>
                </div>

                <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">Update Quiz</button>
            </form>

            <a href="{{ route('teacher.quizzes.index') }}" class="mt-4 inline-block text-blue-500 dark:text-blue-300">Back to Quizzes</a>
        </div>

        <script>
            toggleQuestions(); // Initialize the questions section
        </script>
    </body>
</x-teacher-nav>