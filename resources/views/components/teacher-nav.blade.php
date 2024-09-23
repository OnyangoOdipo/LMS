<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher's Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 h-screen flex">

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar w-64 bg-gray-800 text-white flex flex-col hidden md:flex">
        <div class="p-4 text-lg font-bold">Teacher's Dashboard</div>

        <a href="{{ route('teacher.dashboard') }}" class="py-2 px-4 hover:bg-gray-700 {{ request()->is('dashboard') ? 'bg-gray-700' : '' }}">
            Dashboard
        </a>

        <!-- Quizzes Dropdown -->
        <div class="relative">
            <button class="flex justify-between items-center w-full py-2 px-4 hover:bg-gray-700 focus:outline-none" onclick="toggleDropdown('quizDropdown', 'quizIcon')">
                Quizzes
                <svg class="w-5 h-5 ml-2 transition-transform transform" id="quizIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="quizDropdown" class="hidden absolute left-0 w-full bg-gray-700 z-10">
                <a href="{{ route('teacher.quizzes.index') }}" class="block py-2 px-4 hover:bg-gray-600">All Quizzes</a>
                <a href="{{ route('teacher.quizzes.create') }}" class="block py-2 px-4 hover:bg-gray-600">Create Quiz</a>
            </div>
        </div>

        <!-- Announcements Dropdown -->
        <div class="relative">
            <button class="flex justify-between items-center w-full py-2 px-4 hover:bg-gray-700 focus:outline-none" onclick="toggleDropdown('announcementDropdown', 'announcementIcon')">
                Announcements
                <svg class="w-5 h-5 ml-2 transition-transform transform" id="announcementIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="announcementDropdown" class="hidden absolute left-0 w-full bg-gray-700 z-10">
                <a href="{{ route('teacher.announcements.index') }}" class="block py-2 px-4 hover:bg-gray-600">All Announcements</a>
                <a href="{{ route('teacher.announcements.create') }}" class="block py-2 px-4 hover:bg-gray-600">Create Announcement</a>
            </div>
        </div>

        <!-- Assignments Dropdown (Fixed Icon ID and functionality) -->
        <div class="relative">
            <button class="flex justify-between items-center w-full py-2 px-4 hover:bg-gray-700 focus:outline-none" onclick="toggleDropdown('assignmentDropdown', 'assignmentIcon')">
                Assignments
                <svg class="w-5 h-5 ml-2 transition-transform transform" id="assignmentIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="assignmentDropdown" class="hidden absolute left-0 w-full bg-gray-700 z-10">
                <a href="{{ route('teacher.assignments.index') }}" class="block py-2 px-4 hover:bg-gray-600">All Assignments</a>
                <a href="{{ route('teacher.assignments.create') }}" class="block py-2 px-4 hover:bg-gray-600">Create Assignment</a>
            </div>
        </div>

        <a href="{{ route('teacher.profile.edit') }}" class="py-2 px-4 hover:bg-gray-700 {{ request()->is('profile') ? 'bg-gray-700' : '' }}">
            Profile
        </a>
    </div>

    <!-- Main Content -->
    <div class="flex-grow flex flex-col">
        <!-- Navbar -->
        <nav class="bg-white shadow p-4 flex justify-between items-center sticky top-0 z-10">
            <!-- Sidebar Toggle Button (visible on all screen sizes) -->
            <button id="toggleSidebar" class="text-gray-600 focus:outline-none md:hidden" onclick="toggleSidebar()">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>

            <!-- Dynamic Greeting -->
            <span id="greeting" class="text-xl font-semibold"></span>

            <form method="POST" action="{{ route('teacher.logout') }}">
                @csrf
                <x-dropdown-link :href="route('teacher.logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </nav>

        <div class="flex-grow p-6 space-y-6">
            {{ $slot }}
        </div>
    </div>

    <script>
        // Toggle dropdown and rotate icon
        function toggleDropdown(dropdownId, iconId) {
            const dropdown = document.getElementById(dropdownId);
            const icon = document.getElementById(iconId);
            dropdown.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }

        // Toggle sidebar visibility
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        }

        // Display dynamic greeting based on time of day
        function displayGreeting() {
            const currentHour = new Date().getHours();
            const userName = '{{ auth()->user()->name }}'; // Logged-in teacher's name
            let greetingText = '';

            if (currentHour < 12) {
                greetingText = 'Good morning, ' + userName;
            } else if (currentHour < 18) {
                greetingText = 'Good afternoon, ' + userName;
            } else {
                greetingText = 'Good evening, ' + userName;
            }

            document.getElementById('greeting').textContent = greetingText;
        }

        // Call the greeting function on page load
        document.addEventListener('DOMContentLoaded', displayGreeting);
    </script>

</body>

</html>