<x-teacher-nav>
    <div class="container mx-auto p-8">
        <div class="bg-white shadow-md rounded-lg p-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">Create a New Assignment</h1>

            <form action="{{ route('teacher.assignments.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Assignment Title -->
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-2">Assignment Title</label>
                    <input type="text" name="title" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter assignment title" />
                </div>

                <!-- Instructions -->
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-2">Instructions</label>
                    <textarea name="instructions" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" rows="5" placeholder="Provide detailed instructions for the assignment"></textarea>
                </div>

                <!-- Cohort Selection -->
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-2">Assign To Cohort</label>
                    <select name="cohort" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="1">Cohort 1</option>
                        <option value="2">Cohort 2</option>
                    </select>
                </div>

                <!-- Deadline -->
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-2">Submission Deadline</label>
                    <input type="datetime-local" name="deadline" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <!-- Resource Attachment (Optional) -->
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-2">Attach Resource (Optional)</label>
                    <input type="file" name="resource" class="mt-1 block w-full text-gray-700 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                    <p class="mt-2 text-sm text-gray-500">Accepted file types: PDF, DOCX, PPTX, ZIP</p>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold shadow-lg hover:bg-blue-700 transition-all duration-300">
                        Create Assignment
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-teacher-nav>
