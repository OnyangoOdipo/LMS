<x-teacher-nav>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-3xl">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-600">Your Quizzes</h1>

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-600 p-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($quizzes->isEmpty())
            <p class="text-center text-gray-500">You have not created any quizzes yet.</p>
        @else
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-600">
                        <th class="py-2 px-4 border">Title</th>
                        <th class="py-2 px-4 border">Course</th>
                        <th class="py-2 px-4 border">Quiz Type</th>
                        <th class="py-2 px-4 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quizzes as $quiz)
                        <tr class="text-center hover:bg-gray-100">
                            <td class="py-2 px-4 border">{{ $quiz->title }}</td>
                            <td class="py-2 px-4 border">{{ $quiz->course->title }}</td>
                            <td class="py-2 px-4 border">{{ ucfirst($quiz->quiz_type) }}</td>
                            <td class="py-2 px-4 border">
                                <a href="{{ route('teacher.quizzes.edit', $quiz) }}" class="text-blue-500 hover:underline">Edit</a>
                                <!--<form action="{{ route('teacher.quizzes.destroy', $quiz) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-4">Delete</button>
                                </form>-->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    </x-teacher-nav>