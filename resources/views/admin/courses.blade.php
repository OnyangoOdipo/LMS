<x-admin-nav>
    <!-- Main Content -->
    <main class="flex-1 p-6">
    @include('components.alert')
        <div class="container mx-auto">
            <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">Course Management</h1>

            <!-- Button to open modal for creating a new course -->
            <div class="flex justify-end mb-4">
                <button id="createCourseBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Create New Course
                </button>
            </div>

            <!-- Course Table -->
            <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
                <table class="min-w-full bg-white divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Course Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Duration</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($courses as $course)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $course->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $course->category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $course->duration }} hours</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                <!-- Edit Button -->
                                <button  class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 editCourseBtn" data-id="{{ $course->id }}">
                                    Edit
                                </button>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Modal for creating/editing courses -->
    <div id="courseModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6">
                <h2 id="modalTitle" class="text-2xl font-bold mb-4"></h2>
                <!-- Dynamically update the form action and method -->
                <form id="courseForm" method="POST">
                    @csrf
                    <input type="hidden" name="course_id" id="course_id">
                    <input type="hidden" id="formMethod" name="_method" value="POST"> <!-- Default method is POST -->

                    <!-- Course Title -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Course Title</label>
                        <input type="text" name="title" id="title" class="mt-1 p-2 border w-full rounded-lg" required>
                    </div>

                    <!-- Course Category -->
                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <input type="text" name="category" id="category" class="mt-1 p-2 border w-full rounded-lg" required>
                    </div>

                    <!-- Course Duration -->
                    <div class="mb-4">
                        <label for="duration" class="block text-sm font-medium text-gray-700">Duration (in hours)</label>
                        <input type="number" name="duration" id="duration" class="mt-1 p-2 border w-full rounded-lg" required>
                    </div>

                    <!-- Course Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4" class="mt-1 p-2 border w-full rounded-lg"></textarea>
                    </div>

                    <!-- Course Price -->
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" name="price" id="price" step="0.01" class="mt-1 p-2 border w-full rounded-lg">
                    </div>

                    <!-- Modal Actions -->
                    <div class="flex justify-end">
                        <button type="button" id="cancelBtn" class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded mr-2">Cancel</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const createCourseBtn = document.getElementById('createCourseBtn');
            const courseModal = document.getElementById('courseModal');
            const modalTitle = document.getElementById('modalTitle');
            const cancelBtn = document.getElementById('cancelBtn');
            const courseForm = document.getElementById('courseForm');
            const courseIdInput = document.getElementById('course_id');
            const formMethod = document.getElementById('formMethod');

            // Show the "Create New Course" modal
            createCourseBtn.addEventListener('click', () => {
                courseForm.action = "{{ route('admin.courses.store') }}";
                formMethod.value = 'POST';  // Set form method to POST
                modalTitle.textContent = 'Create New Course';
                courseForm.reset();
                courseModal.classList.remove('hidden');
            });

            // Hide the modal when the cancel button is clicked
            cancelBtn.addEventListener('click', () => {
                courseModal.classList.add('hidden');
            });

            // Event delegation for dynamically handling the edit buttons
            document.querySelector('tbody').addEventListener('click', function (event) {
                if (event.target.classList.contains('editCourseBtn')) {
                    const courseId = event.target.getAttribute('data-id');
                    // Fetch the course data for editing
                    fetch(`/admin/courses/${courseId}/edit`)
                        .then(response => response.json())  // Ensure the response is in JSON format
                        .then(course => {
                            modalTitle.textContent = 'Edit Course';
                            courseForm.action = `/admin/courses/${courseId}`;
                            formMethod.value = 'PUT'; // Set form method to PUT for editing
                            courseIdInput.value = course.id;
                            document.getElementById('title').value = course.title;
                            document.getElementById('category').value = course.category;
                            document.getElementById('duration').value = course.duration;
                            document.getElementById('description').value = course.description;
                            document.getElementById('price').value = course.price;
                            courseModal.classList.remove('hidden');  // Show the modal
                        })
                        .catch(error => {
                            console.error('Error fetching course data:', error);
                            alert('Error fetching course data. Please try again.');
                        });
                }
            });
        });
    </script>
</x-admin-nav>
