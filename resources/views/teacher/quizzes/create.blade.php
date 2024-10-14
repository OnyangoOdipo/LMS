<x-teacher-nav>
    <style>
        .hidden { display: none; }
    </style>
    <script>
        // Function to dynamically show question section when multiple choice is selected
        function toggleQuestions() {
            var quizType = document.getElementById('quiz_type').value;
            var questionsSection = document.getElementById('questions_section');
            if (quizType === 'multiple_choice') {
                questionsSection.classList.remove('hidden');
            } else {
                questionsSection.classList.add('hidden');
            }
        }

        // Function to add a new question
        function addQuestion() {
            var questionsContainer = document.getElementById('questions_container');
            var questionIndex = questionsContainer.children.length;
            
            // Create question input
            var questionDiv = document.createElement('div');
            questionDiv.classList.add('mb-4', 'p-4', 'bg-gray-100', 'rounded-lg');
            questionDiv.innerHTML = `
                <label class="block font-bold text-lg mb-2">Question ${questionIndex + 1}:</label>
                <input type="text" name="questions[${questionIndex}][question]" required
                    class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                <div>
                    <label class="block font-bold mb-2">Choices:</label>
                    <div id="choices_container_${questionIndex}" class="space-y-2"></div>
                    <button type="button" onclick="addChoice(${questionIndex})"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Add Choice
                    </button>
                </div>
            `;
            questionsContainer.appendChild(questionDiv);
        }

        // Function to add choices for a question
        function addChoice(questionIndex) {
            var choicesContainer = document.getElementById(`choices_container_${questionIndex}`);
            var choiceIndex = choicesContainer.children.length;

            // Create choice input with correct answer checkbox
            var choiceDiv = document.createElement('div');
            choiceDiv.classList.add('flex', 'items-center', 'space-x-2');
            choiceDiv.innerHTML = `
                <input type="text" name="questions[${questionIndex}][choices][${choiceIndex}][choice]" required
                    class="w-2/3 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                <label class="text-gray-700 font-bold">Correct</label>
                <input type="checkbox" name="questions[${questionIndex}][choices][${choiceIndex}][is_correct]" value="1"
                    class="w-5 h-5 text-blue-500 focus:outline-none">
            `;
            choicesContainer.appendChild(choiceDiv);
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-3xl">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-600">Create a New Quiz</h1>

        @if($errors->any())
            <div class="mb-6">
                <ul class="bg-red-100 text-red-600 p-4 rounded-lg">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teacher.quizzes.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div>
                    <label for="title" class="block text-lg font-medium text-gray-700">Title:</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label for="course_id" class="block text-lg font-medium text-gray-700">Course:</label>
                    <select name="course_id" id="course_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div>
                    <label for="quiz_type" class="block text-lg font-medium text-gray-700">Quiz Type:</label>
                    <select name="quiz_type" id="quiz_type" onchange="toggleQuestions()" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                        <option value="multiple_choice" {{ old('quiz_type') == 'multiple_choice' ? 'selected' : '' }}>Multiple Choice</option>
                        <option value="teacher_reviewed" {{ old('quiz_type') == 'teacher_reviewed' ? 'selected' : '' }}>Teacher Reviewed</option>
                    </select>
                </div>

                <div>
                    <label for="cohort" class="block text-lg font-medium text-gray-700">Cohort:</label>
                    <input type="number" name="cohort" id="cohort" value="{{ old('cohort') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div>
                    <label for="start_time" class="block text-lg font-medium text-gray-700">Start Time:</label>
                    <input type="datetime-local" name="start_time" id="start_time" value="{{ old('start_time') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label for="end_time" class="block text-lg font-medium text-gray-700">End Time:</label>
                    <input type="datetime-local" name="end_time" id="end_time" value="{{ old('end_time') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="mb-4">
                <label for="duration" class="block text-lg font-medium text-gray-700">Duration (minutes):</label>
                <input type="number" name="duration" id="duration" value="{{ old('duration') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>

            <!-- Questions section -->
            <div id="questions_section" class="hidden mb-6">
                <h3 class="text-xl font-bold mb-4 text-blue-600">Add Questions and Choices</h3>
                <div id="questions_container" class="space-y-4"></div>
                <button type="button" onclick="addQuestion()"
                    class="mt-4 bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                    Add Question
                </button>
            </div>

            <div class="text-center">
                <button type="submit"
                    class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition-colors">
                    Create Quiz
                </button>
            </div>
        </form>
    </div>

    <script>
        toggleQuestions();
    </script>
</x-teacher-nav>
