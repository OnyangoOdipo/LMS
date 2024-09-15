<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- User Information & Welcome Message -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Welcome back, " . Auth::user()->name) }}
                </div>
            </div>

            <x-responsive-nav-link :href="route('video')">
                    {{ __('Video Call') }}
            </x-responsive-nav-link>

            <!-- Enrolled Courses Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">
                        <i class="fas fa-graduation-cap text-blue-500"></i> {{ __("Software Engineering") }}
                    </h3>
                    <ul class="space-y-4">
                        <li>
                            <div class="flex justify-between items-center">
                                <span><strong>Module 1<br>Introduction to Software Engineering</strong></span>
                                <span class="text-gray-500">Progress: 0%</span>
                            </div>
                            <div class="w-full bg-gray-300 rounded-full h-2.5 mt-1">
                                <div class="bg-blue-500 h-2.5 rounded-full" style="width: 0%;"></div>
                            </div>
                        </li>
                        <li>
                            <div class="flex justify-between items-center">
                                <span><strong>Module 2<br>Data Structures and Algorithms</strong></span>
                                <span class="text-gray-500">Progress: 0%</span>
                            </div>
                            <div class="w-full bg-gray-300 rounded-full h-2.5 mt-1">
                                <div class="bg-blue-500 h-2.5 rounded-full" style="width: 0%;"></div>
                            </div>
                        </li>
                        <li>
                            <div class="flex justify-between items-center">
                                <span><strong>Module 3<br>Web Development</strong></span>
                                <span class="text-gray-500">Progress: 0%</span>
                            </div>
                            <div class="w-full bg-gray-300 rounded-full h-2.5 mt-1">
                                <div class="bg-blue-500 h-2.5 rounded-full" style="width: 0%;"></div>
                            </div>
                        </li>
                    </ul>
                    <a href="#" class="mt-4 inline-block text-blue-500 hover:underline">View Course Details</a>
                </div>
            </div>

            <!-- Announcements Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">
                        <i class="fas fa-bullhorn text-yellow-500"></i> {{ __("Announcements") }}
                    </h3>
                    <ul class="space-y-4">
                        <li>
                            <div class="flex justify-between items-center">
                                <div>
                                    <strong>Platform Update</strong>
                                    <p class="text-sm text-gray-400">This is temporary just to allow students to signup.</p>
                                </div>
                                <span class="text-sm text-gray-500">Just Now</span>
                            </div>
                        </li>
                        <!--<li>
                <div class="flex justify-between items-center">
                    <div>
                        <strong>Important Notice</strong>
                        <p class="text-sm text-gray-400">Another important update.</p>
                    </div>
                    <span class="text-sm text-gray-500">1 day ago</span>
                </div>
            </li>-->
                    </ul>
                    <a href="#" class="mt-4 inline-block text-blue-500 hover:underline">View All Announcements</a>
                </div>
            </div>

            <!-- Upcoming Assignments/Quizzes Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">
                        <i class="fas fa-calendar-alt text-blue-500"></i> {{ __("Upcoming Assignments & Quizzes") }}
                    </h3>
                    <ul class="list-disc list-inside">
                        <li class="mb-4">
                            <div class="flex justify-between">
                                <span><strong>Make sure you have a GitHub Account</strong></span>
                                <span class="text-gray-500">Due: September 16, 2024</span>
                            </div>
                            <p class="text-sm text-gray-400 mt-1">Task: Create an account on GitHub if you haven't already.</p>
                        </li>
                        <li class="mb-4">
                            <div class="flex justify-between">
                                <span><strong>Install Git on your local machine</strong></span>
                                <span class="text-gray-500">Due: September 16, 2024</span>
                            </div>
                            <p class="text-sm text-gray-400 mt-1">Task: Ensure Git is installed and properly set up on your device.</p>
                        </li>
                    </ul>
                    <a href="#" class="mt-4 inline-block text-blue-500 hover:underline">View All Assignments</a>
                </div>
            </div>

            <!-- Resources Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">
                        <i class="fas fa-book text-green-500"></i> {{ __("Resources & Materials") }}
                    </h3>
                    <ul class="list-none">
                        <li class="mb-4">
                            <a href="https://github.com" target="_blank" class="text-blue-500 hover:underline">
                                <i class="fas fa-link"></i> Create a GitHub Account
                            </a>
                            <p class="text-sm text-gray-400 mt-1">Visit GitHub and create an account to manage your projects.</p>
                        </li>
                        <li class="mb-4">
                            <a href="https://www.youtube.com/watch?v=v1noKTXiTnM&pp=ygUZc2V0dGluZyB1cCBnaXQgb24gd2luZG93cw%3D%3D" target="_blank" class="text-blue-500 hover:underline">
                                <i class="fas fa-video"></i> Setting Up Git on Windows
                            </a>
                            <p class="text-sm text-gray-400 mt-1">Follow this tutorial to set up Git on your local machine.</p>
                        </li>
                    </ul>
                    <a href="#" class="mt-4 inline-block text-blue-500 hover:underline">Explore More Resources</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>