<x-admin-nav>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-4">Student Management</h1>

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
    </div>
</x-admin-nav>
