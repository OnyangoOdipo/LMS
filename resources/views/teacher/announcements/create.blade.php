<x-teacher-nav>
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-4">Create Announcement</h1>

        <form action="{{ route('teacher.announcements.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="4"></textarea>
            </div>

            <!-- Cohort Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Cohort</label>
                <select name="cohort" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="1">Cohort 1</option>
                    <option value="2">Cohort 2</option>
                </select>
            </div>

            <!-- Urgency Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Urgency</label>
                <select name="urgency" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="low" class="text-green-600">Low</option>
                    <option value="medium" class="text-yellow-500">Medium</option>
                    <option value="high" class="text-red-600">High</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg">
                Create Announcement
            </button>
        </form>
    </div>
</x-teacher-nav>
