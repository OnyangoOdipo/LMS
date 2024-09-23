<x-teacher-nav>
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-6">{{ $assignment->title }}</h1>

        <div class="mb-6">
            <strong>Cohort: </strong> {{ $assignment->cohort == 1 ? 'Cohort 1' : 'Cohort 2' }}
        </div>

        <div class="mb-6">
            <strong>Instructions: </strong> 
            <p class="mt-2">{{ $assignment->instructions }}</p>
        </div>

        <div class="mb-6">
            <strong>Deadline: </strong> {{ $assignment->deadline }}
        </div>

        @if($assignment->resource)
            <div class="mb-6">
                <strong>Attached Resource: </strong> 
                <a href="{{ asset('storage/' . $assignment->resource) }}" class="text-blue-500 hover:text-blue-700" download>Download</a>
            </div>
        @endif

        <a href="{{ route('teacher.assignments.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Back to Assignments</a>
    </div>
</x-teacher-nav>
