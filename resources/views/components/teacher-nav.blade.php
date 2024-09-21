<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dark {
            background-color: #1a202c;
            color: #cbd5e0;
        }

        .dark .sidebar {
            background-color: #2d3748;
            color: #cbd5e0;
        }

        .sidebar {
            background-color: #f8fafc;
            color: #1a202c;
        }

        .dark .navbar {
            background-color: #2d3748;
            color: #cbd5e0;
        }

        .navbar {
            background-color: #f8fafc;
            color: #1a202c;
        }

        .dark .dropdown {
            background-color: #2d3748;
            color: #cbd5e0;
        }

        .dropdown {
            background-color: #f8fafc;
            color: #1a202c;
        }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 dark:text-gray-200">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar text-gray-800 dark:text-gray-200 w-64 p-5 flex flex-col h-full">
        <div class="shrink-0 flex items-center">
                    <a href="{{ route('teacher.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>
            <h1 class="text-2xl font-bold mb-5">Teacher Dashboard</h1>
            <ul>
                <li class="mb-3">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                    <button class="flex items-center justify-between w-full p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none"
                        onclick="toggleQuizDropdown()">
                        <div class="flex items-center">
                            <i class="fas fa-question-circle mr-2"></i> Quizzes
                        </div>
                        <i id="quizDropdownIcon" class="fas fa-chevron-down"></i>
                    </button>
                    <ul id="quizDropdownMenu" class="pl-5 hidden">
                        <li class="mb-2">
                            <a href="{{ route('teacher.quizzes.index') }}"
                                class="flex items-center p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700
                                {{ request()->routeIs('teacher.quizzes.index') ? 'bg-gray-300 dark:bg-gray-600' : '' }}">
                                Index
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('teacher.quizzes.create') }}"
                                class="flex items-center p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700
                                {{ request()->routeIs('teacher.quizzes.create') ? 'bg-gray-300 dark:bg-gray-600' : '' }}">
                                Create
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-5 flex flex-col">
            <!-- Navbar -->
            <nav class="navbar shadow flex items-center justify-between p-4">
                <div class="text-xl font-semibold">@yield('header')</div>
                <div class="relative">
                    <button id="profileDropdownButton" class="flex items-center p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700">
                        Teacher
                        <i id="profileDropdownArrow" class="fas fa-chevron-down ml-1"></i>
                    </button>
                    <div class="dropdown absolute right-0 mt-2 w-48 rounded-md shadow-lg z-20 hidden" id="profileDropdownMenu">
                        <button id="themeToggle" class="p-2 w-full text-left rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">
                            <i id="themeIcon" class="fas fa-sun"></i>
                            <span class="ml-2">Toggle Theme</span>
                        </button>
                        <a href="route(teacher.profile.edit)" class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-700">Profile</a>
                        <a href="logout" class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-700">Logout</a>
                    </div>
                </div>
            </nav>

            <!-- Main Content Section -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex-1 mt-4">
                {{ $slot }}
            </div>
        </div>
    </div>

    <script>
        // Profile Dropdown Toggle
        document.getElementById('profileDropdownButton').onclick = function() {
            const profileDropdownMenu = document.getElementById('profileDropdownMenu');
            const profileDropdownArrow = document.getElementById('profileDropdownArrow');

            profileDropdownMenu.classList.toggle('hidden');
            profileDropdownArrow.classList.toggle('fa-chevron-up');
            profileDropdownArrow.classList.toggle('fa-chevron-down');
        };

        // Quiz Dropdown Toggle
        function toggleQuizDropdown() {
            const quizDropdownMenu = document.getElementById('quizDropdownMenu');
            const quizDropdownIcon = document.getElementById('quizDropdownIcon');

            quizDropdownMenu.classList.toggle('hidden');
            quizDropdownIcon.classList.toggle('fa-chevron-up');
            quizDropdownIcon.classList.toggle('fa-chevron-down');
        }

        // Theme Toggle
        document.getElementById('themeToggle').onclick = function() {
            document.body.classList.toggle('dark');
            const themeIcon = document.getElementById('themeIcon');
            themeIcon.classList.toggle('fa-sun');
            themeIcon.classList.toggle('fa-moon');

            if (document.body.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        };

        // Apply stored theme on page load
        window.onload = function() {
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark');
                const themeIcon = document.getElementById('themeIcon');
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        };

        // Close profile dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.matches('#profileDropdownButton')) {
                const profileDropdownMenu = document.getElementById('profileDropdownMenu');
                profileDropdownMenu.classList.add('hidden');
                const profileDropdownArrow = document.getElementById('profileDropdownArrow');
                profileDropdownArrow.classList.remove('fa-chevron-up');
                profileDropdownArrow.classList.add('fa-chevron-down');
            }
        };
    </script>
</body>

</html>