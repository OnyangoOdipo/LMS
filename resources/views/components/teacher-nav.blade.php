<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCH Teacher's Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar-transition {
            transition: all 0.3s ease-in-out;
        }
        @media (max-width: 768px) {
            .sidebar-open {
                transform: translateX(0) !important;
            }
        }
    </style>
</head>

<body class="bg-gray-100 h-screen flex flex-col md:flex-row overflow-hidden">

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar-transition w-64 bg-blue-900 text-white flex flex-col fixed h-full left-0 top-0 z-30 transform -translate-x-full md:relative md:translate-x-0">
        <div class="p-6 text-2xl font-bold flex items-center space-x-3">
            <i class="fas fa-laptop-code"></i>
            <span>BCH Dashboard</span>
        </div>

        <nav class="flex-grow overflow-y-auto">
            <a href="{{ route('teacher.dashboard') }}" class="flex items-center py-3 px-6 hover:bg-blue-800 transition-colors {{ request()->is('dashboard') ? 'bg-blue-800' : '' }}">
                <i class="fas fa-home w-5 mr-3"></i> Dashboard
            </a>

            <!-- Quizzes -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full py-3 px-6 hover:bg-blue-800 transition-colors focus:outline-none">
                    <div class="flex items-center">
                        <i class="fas fa-question-circle w-5 mr-3"></i> Quizzes
                    </div>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'transform rotate-180': open }"></i>
                </button>
                <div x-show="open" class="bg-blue-950">
                    <a href="{{ route('teacher.quizzes.index') }}" class="block py-2 px-10 hover:bg-blue-800 transition-colors">All Quizzes</a>
                    <a href="{{ route('teacher.quizzes.create') }}" class="block py-2 px-10 hover:bg-blue-800 transition-colors">Create Quiz</a>
                </div>
            </div>

            <!-- Announcements -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full py-3 px-6 hover:bg-blue-800 transition-colors focus:outline-none">
                    <div class="flex items-center">
                        <i class="fas fa-bullhorn w-5 mr-3"></i> Announcements
                    </div>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'transform rotate-180': open }"></i>
                </button>
                <div x-show="open" class="bg-blue-950">
                    <a href="{{ route('teacher.announcements.index') }}" class="block py-2 px-10 hover:bg-blue-800 transition-colors">All Announcements</a>
                    <a href="{{ route('teacher.announcements.create') }}" class="block py-2 px-10 hover:bg-blue-800 transition-colors">Create Announcement</a>
                </div>
            </div>

            <!-- Assignments -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full py-3 px-6 hover:bg-blue-800 transition-colors focus:outline-none">
                    <div class="flex items-center">
                        <i class="fas fa-tasks w-5 mr-3"></i> Assignments
                    </div>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'transform rotate-180': open }"></i>
                </button>
                <div x-show="open" class="bg-blue-950">
                    <a href="{{ route('teacher.assignments.index') }}" class="block py-2 px-10 hover:bg-blue-800 transition-colors">All Assignments</a>
                    <a href="{{ route('teacher.assignments.create') }}" class="block py-2 px-10 hover:bg-blue-800 transition-colors">Create Assignment</a>
                </div>
            </div>

            <a href="{{ route('teacher.profile.edit') }}" class="flex items-center py-3 px-6 hover:bg-blue-800 transition-colors {{ request()->is('profile') ? 'bg-blue-800' : '' }}">
                <i class="fas fa-user-circle w-5 mr-3"></i> Profile
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-grow flex flex-col w-full md:w-auto">
        <!-- Navbar -->
        <nav class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-20">
            <button id="toggleSidebar" class="text-blue-900 focus:outline-none md:hidden" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>

            <span id="greeting" class="text-xl font-semibold text-blue-900 hidden sm:inline-block"></span>

            <div class="flex items-center space-x-4">
                <button class="text-blue-900 hover:text-blue-700 transition-colors relative">
                    <i class="fas fa-bell"></i>
                    <span class="absolute top-0 right-0 -mt-1 -mr-1 bg-red-500 text-white rounded-full text-xs w-4 h-4 flex items-center justify-center">3</span>
                </button>
                <form method="POST" action="{{ route('teacher.logout') }}">
                    @csrf
                    <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <span class="hidden sm:inline">Log Out</span>
                        <i class="fas fa-sign-out-alt sm:hidden"></i>
                    </button>
                </form>
            </div>
        </nav>

        <div class="flex-grow p-4 md:p-6 space-y-6 overflow-y-auto">
            {{ $slot }}
        </div>
    </div>

    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-20 hidden md:hidden" onclick="toggleSidebar()"></div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('sidebar-open');
            overlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        }

        function displayGreeting() {
            const currentHour = new Date().getHours();
            const userName = '{{ auth()->user()->name }}';
            let greetingText = '';
            let greetingIcon = '';

            if (currentHour < 12) {
                greetingText = 'Good morning, ' + userName;
                greetingIcon = '<i class="fas fa-sun text-yellow-500 mr-2"></i>';
            } else if (currentHour < 18) {
                greetingText = 'Good afternoon, ' + userName;
                greetingIcon = '<i class="fas fa-cloud-sun text-orange-500 mr-2"></i>';
            } else {
                greetingText = 'Good evening, ' + userName;
                greetingIcon = '<i class="fas fa-moon text-blue-500 mr-2"></i>';
            }

            document.getElementById('greeting').innerHTML = greetingIcon + greetingText;
        }

        document.addEventListener('DOMContentLoaded', () => {
            displayGreeting();
            setInterval(displayGreeting, 60000); // Update greeting every minute
        });

        // Adjust sidebar on window resize
        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('sidebar-open');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });
    </script>

</body>

</html>