<x-teacher-nav>
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-6">My Assignments</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('teacher.assignments.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-6 inline-block">Create Assignment</a>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-4">Title</th>
                        <th class="py-2 px-4">Cohort</th>
                        <th class="py-2 px-4">Deadline</th>
                        <th class="py-2 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignments as $assignment)
                        <tr class="border-b">
                            <td class="py-2 px-4">{{ $assignment->title }}</td>
                            <td class="py-2 px-4">{{ $assignment->cohort == 1 ? 'Cohort 1' : 'Cohort 2' }}</td>
                            <td class="py-2 px-4">{{ $assignment->deadline }}</td>
                            <td class="py-2 px-4">
                                <a href="{{ route('teacher.assignments.show', $assignment->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">View</a>
                                <a href="{{ route('teacher.assignments.submissions', ['assignment' => $assignment->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Submissions</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center">No assignments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-teacher-nav>
