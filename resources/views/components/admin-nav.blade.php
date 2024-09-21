<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCH - Admin Dashboard</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- AOS (Animate On Scroll) Library for animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Logo -->
    <link rel="icon" type="image/jpeg" href="{{ asset('storage/images/favicon.jpeg') }}" />

    <style>
        body {
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        .dark-mode {
            background-color: #1a202c;
            color: #e2e8f0;
        }

        /* Transition Effects */
        .transition-colors {
            transition: color 0.3s ease, background-color 0.3s ease;
        }

        /* Smooth transitions for the sidebar */
        aside {
            transition: transform 0.3s ease, width 0.3s ease;
        }

        /* Sidebar collapsed state */
        .sidebar-collapsed {
            width: 64px;
        }

        .sidebar-collapsed .sidebar-text {
            display: none;
        }

        .dark-mode .bg-gray-800 {
            background-color: #2d3748;
        }

        .dark-mode .bg-gray-900 {
            background-color: #1a202c;
        }

        .dark-mode .bg-gray-700 {
            background-color: #4a5568;
        }

        .dark-mode .text-gray-300 {
            color: #e2e8f0;
        }
    </style>
</head>

<body class="bg-gray-100 transition-colors">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-gray-800 text-white flex flex-col dark:bg-gray-900">
            <div class="p-4 text-center font-bold text-lg flex items-center justify-between">
                <span class="sidebar-text">BCH Dashboard</span>
                <button id="sidebarCollapse" class="focus:outline-none text-white hover:text-gray-400 transition">
                    <i class="fas fa-angle-double-left"></i>
                </button>
            </div>
            <nav class="mt-6">
                <a href="#" class="flex items-center py-2 px-4 hover:bg-gray-700 transition-colors dark:hover:bg-gray-600">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="ml-3 sidebar-text">Dashboard</span>
                </a>
                <a href="#" class="flex items-center py-2 px-4 hover:bg-gray-700 transition-colors dark:hover:bg-gray-600">
                    <i class="fas fa-book"></i>
                    <span class="ml-3 sidebar-text">Courses</span>
                </a>
                <a href="#" class="flex items-center py-2 px-4 hover:bg-gray-700 transition-colors dark:hover:bg-gray-600">
                    <i class="fas fa-user-graduate"></i>
                    <span class="ml-3 sidebar-text">Students</span>
                </a>
                <a href="#" class="flex items-center py-2 px-4 hover:bg-gray-700 transition-colors dark:hover:bg-gray-600">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span class="ml-3 sidebar-text">Teachers</span>
                </a>
                <a href="#" class="flex items-center py-2 px-4 hover:bg-gray-700 transition-colors dark:hover:bg-gray-600">
                    <i class="fas fa-cog"></i>
                    <span class="ml-3 sidebar-text">Settings</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="bg-gray-800 text-white p-4 flex justify-between items-center transition-colors dark:bg-gray-900">
                <button id="sidebarToggle" class="text-white focus:outline-none">
                    <i class=""></i>
                </button>
                <div class="flex items-center space-x-4">
                    <button id="themeToggle" class="p-2 bg-gray-700 rounded-full hover:bg-gray-600 transition-colors dark:bg-gray-600 dark:hover:bg-gray-500">
                        <i class="fas fa-moon"></i>
                    </button>
                    <button class="p-2 bg-blue-500 rounded-full hover:bg-blue-400 transition-colors">
                        <i class="fas fa-user"></i>
                    </button>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- JS -->
    <script>
        // Sidebar Collapse Toggle
        const sidebarCollapse = document.getElementById('sidebarCollapse');
        const sidebar = document.getElementById('sidebar');
        sidebarCollapse.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
            sidebarCollapse.innerHTML = sidebar.classList.contains('sidebar-collapsed') ?
                '<i class="fas fa-angle-double-right"></i>' :
                '<i class="fas fa-angle-double-left"></i>';
        });

        // Dark Mode Toggle
        const themeToggle = document.getElementById('themeToggle');
        const rootElement = document.documentElement;

        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            rootElement.classList.toggle('dark');
            themeToggle.innerHTML = document.body.classList.contains('dark-mode') ?
                '<i class="fas fa-sun"></i>' :
                '<i class="fas fa-moon"></i>';
        });

        // Sidebar Toggle for mobile view
        const sidebarToggle = document.getElementById('sidebarToggle');
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });

        // AOS initialization for scroll animations
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>
    
    <!-- AOS JS Library -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
</body>

</html>