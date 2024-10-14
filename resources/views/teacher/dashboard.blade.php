<x-teacher-nav>
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-blue-600">Teacher Dashboard</h1>

        <!-- Overview Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Quizzes Card -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Quizzes</h2>
                <p class="text-3xl font-bold text-blue-600">12</p>
                <p class="text-gray-500">Total Quizzes Created</p>
                <a href="{{ route('teacher.quizzes.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">Manage Quizzes</a>
            </div>

            <!-- Assignments Card -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Assignments</h2>
                <p class="text-3xl font-bold text-blue-600">8</p>
                <p class="text-gray-500">Total Assignments Issued</p>
                <a href="{{ route('teacher.assignments.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">Manage Assignments</a>
            </div>

            <!-- Announcements Card -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Announcements</h2>
                <p class="text-3xl font-bold text-blue-600">5</p>
                <p class="text-gray-500">Announcements Posted</p>
                <a href="{{ route('teacher.announcements.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">Manage Announcements</a>
            </div>

            <!-- Recent Activity Card -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Recent Activity</h2>
                <ul class="list-disc pl-5">
                    <li class="text-gray-600 mb-2">You graded Assignment #8</li>
                    <li class="text-gray-600 mb-2">Quiz #5 completed by Cohort 2</li>
                    <li class="text-gray-600 mb-2">You created Announcement #3</li>
                </ul>
            </div>
        </div>

        <!-- Detailed Insights Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Detailed Insights</h2>
            <p class="text-gray-600 mb-4">Track the progress of your students through quizzes and assignments.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Student Progress Card -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-bold text-gray-700 mb-4">Student Progress</h3>
                    <p class="text-gray-600">80% of students have completed their latest assignments.</p>
                </div>

                <!-- Quiz Completion Rate -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-bold text-gray-700 mb-4">Quiz Completion Rate</h3>
                    <p class="text-gray-600">75% of students in Cohort 1 completed their quizzes on time.</p>
                    <a href="{{ route('teacher.quizzes.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">View Quizzes</a>
                </div>
            </div>
        </div>
    </div>
</x-teacher-nav>
