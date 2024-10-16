<x-admin-nav>
    <div class="container mx-auto p-6">
    <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold mb-4">Student Management</h1>
            <!-- Button to open modal for adding a new teacher -->
            <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="openModal()">Add New Student</button>
        </div>

        <!-- Success/Error Alerts -->
        @include('components.alert')

        <!-- Registered Students Table -->
        <div class="overflow-x-auto">
            <h2 class="text-xl font-semibold mb-4">Students</h2>
            <table class="min-w-full bg-white shadow-md rounded mb-4">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr class="bg-gray-100">
                        <td class="border px-4 py-2">{{ $student->id }}</td>
                        <td class="border px-4 py-2">{{ $student->name }}</td>
                        <td class="border px-4 py-2">{{ $student->email }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('admin.delete.user', $student->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Modal for Adding New Teacher -->
        <div id="addTeacherModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                    <h3 class="text-lg font-semibold mb-4">Add New Student</h3>
                    <form action="{{ route('admin.store.user') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg">
                        </div>
                        <div class="flex justify-end">
                            <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2" onclick="closeModal()">Cancel</button>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Student</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('addTeacherModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('addTeacherModal').classList.add('hidden');
        }
    </script>
</x-admin-nav>
