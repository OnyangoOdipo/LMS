<x-student-nav>
    <div class="container mx-auto mt-8 px-4 lg:px-0">
        <!-- Page Heading -->
        <h2 class="text-3xl font-bold text-blue-900 mb-6">Your Assignments</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Assignments List -->
        @foreach($assignments as $assignment)
            <div class="bg-white p-6 rounded-lg shadow-md mb-6 hover:shadow-lg transition-shadow duration-200 ease-in-out">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $assignment->title }}</h3>
                    <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($assignment->deadline)->format('M d, Y') }}</span>
                    </div>
                <p class="text-gray-700 mt-2">{{ $assignment->instructions }}</p>
                <div class="mt-4">
                    @php
                        $submission = $assignment->submissions()->where('student_id', auth()->id())->first();
                    @endphp

                    @if($submission)
                        <p class="text-green-700 font-medium">Submission Status: Submitted</p>
                        <p class="text-gray-700"><strong>Score:</strong> {{ $submission->score ?? 'Not graded yet' }}</p>
                        <p><strong>View Submission:</strong> <a href="{{ asset('storage/' . $submission->submission_file) }}" class="text-blue-600 underline" target="_blank">Download File</a></p>
                    @else
                        <!-- Submission Form -->
                        <form action="{{ route('assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                            @csrf
                            <label for="submission_file" class="block text-sm font-medium text-gray-700 mb-2">Upload your submission</label>
                            <input type="file" name="submission_file" id="submission_file" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            
                            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition duration-150 ease-in-out">Submit Assignment</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach

        <!-- No Assignments Message -->
        @if($assignments->isEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                <p class="font-bold">No assignments available</p>
                <p>There are no assignments for you to complete at the moment.</p>
            </div>
        @endif
    </div>
</x-student-nav>