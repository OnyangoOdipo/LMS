<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCH - Learning Management System</title>

    <!-- Tailwind CSS (or any CSS framework of your choice) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- AOS (Animate On Scroll) Library for animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Logo -->
    <link rel="icon" type="image/jpeg" href="{{ asset('storage/images/favicon.jpeg') }}" />
</head>

<body>

    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <!-- Logo Image -->
                <img src="{{ asset('storage/images/logo.jpeg') }}" class="w-20 h-20 fill-current text-gray-500" alt="Logo">

                <!-- BCH Text -->
                <a href="/" class="text-white text-3xl font-bold">
                    BCH
                </a>
            </div>

            <div>
                @if (Auth::check())
                <!-- If the user is logged in -->
                <a href="{{ route('logout') }}"
                    class="bg-red-500 text-white px-4 py-2 rounded-lg"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                @else
                <!-- If the user is not logged in -->
                <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Login</a>
                <a href="{{ route('register') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Register</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero bg-cover bg-center py-32" style="background-image: url('{{ asset('storage/images/african-students.jpg') }}');">
        <div class="container mx-auto text-center text-white">
            <h1 class="text-5xl font-bold mb-4">Learn Your Way, Anytime, Anywhere</h1>
            <p class="text-lg mb-6">Join thousands of learners across the world and master new skills with our comprehensive courses in software engineering.</p>
            <a href="#features" class="btn bg-yellow-500 text-white px-6 py-3 rounded-full">Discover More</a>
        </div>
    </section>

    <section id="features" class="py-20 bg-gray-100 dark:bg-gray-900">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1: Video Learning -->
            <div class="feature text-center p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg flex flex-col items-center">
                <img src="{{ asset('storage/images/video-learning.jpg') }}" alt="Video Learning" class="w-full h-60 object-cover rounded-t-lg mb-4">
                <h2 class="text-2xl font-semibold mb-2 text-gray-800 dark:text-gray-200">Video Learning</h2>
                <p class="text-gray-600 dark:text-gray-400">Access a wide range of tutorials and lectures designed to enhance your software engineering skills, available on-demand.</p>
            </div>
            <!-- Feature 2: Interactive Coding Exercises -->
            <div class="feature text-center p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg flex flex-col items-center">
                <img src="{{ asset('storage/images/coding-exercises.png') }}" alt="Interactive Coding Exercises" class="w-full h-60 object-cover rounded-t-lg mb-4">
                <h2 class="text-2xl font-semibold mb-2 text-gray-800 dark:text-gray-200">Interactive Coding Exercises</h2>
                <p class="text-gray-600 dark:text-gray-400">Practice coding with real-time feedback through interactive exercises that adapt to your skill level.</p>
            </div>
            <!-- Feature 3: Collaborative Projects -->
            <div class="feature text-center p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg flex flex-col items-center">
                <img src="{{ asset('storage/images/collaboration.jpeg') }}" alt="Collaborative Projects" class="w-full h-60 object-cover rounded-t-lg mb-4">
                <h2 class="text-2xl font-semibold mb-2 text-gray-800 dark:text-gray-200">Collaborative Projects</h2>
                <p class="text-gray-600 dark:text-gray-400">Work on projects with peers and mentors, leveraging tools for version control and team collaboration to build real-world applications.</p>
            </div>
        </div>
    </section>


    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20">
        <div class="container mx-auto">
            <h2 class="text-4xl font-bold text-center mb-10">What Our Students Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="testimonial bg-white p-6 rounded-lg shadow-lg" data-aos="fade-up">
                    <img src="{{ asset('images/student1.jpg') }}" alt="Student" class="mb-4 w-16 h-16 object-cover rounded-full">
                    <p class="text-gray-600">"The best platform for learning in my native language. I can now study at my own pace!"</p>
                    <p class="text-yellow-500 mt-2 font-semibold">- Amina, Kenya</p>
                </div>
                <div class="testimonial bg-white p-6 rounded-lg shadow-lg" data-aos="fade-up">
                    <img src="{{ asset('images/student2.jpg') }}" alt="Student" class="mb-4 w-16 h-16 object-cover rounded-full">
                    <p class="text-gray-600">"Interactive and easy to use. I love how I can connect with my teachers anytime!"</p>
                    <p class="text-yellow-500 mt-2 font-semibold">- Kwame, Ghana</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Demo Section -->
    <section id="video-demo" class="py-20 bg-gray-900 text-white">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold mb-6">Watch How Our LMS Works</h2>
            <video width="800" controls class="mx-auto" data-aos="fade-up">
                <source src="{{ asset('videos/lms-demo.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </section>

    <!-- Instructors Section -->
    <!-- Instructors Section -->
    <section id="contact" class="py-20 bg-gray-100 dark:bg-gray-900">
        <div class="container mx-auto">
            <!-- Instructors Header -->
            <h2 class="text-4xl font-bold text-center mb-10 text-gray-800 dark:text-gray-200">Meet Our Instructors</h2>

            <!-- Grid for Instructor Layout -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Top Row: Full Width Instructors -->
                <div class="flex flex-col md:col-span-1 space-y-8">
                    <!-- Instructor 1 -->
                    <div class="instructor text-center p-6 bg-gradient-to-r from-yellow-400 via-orange-500 to-red-500 rounded-lg shadow-lg transform transition-transform duration-500 hover:scale-105 hover:shadow-xl ">
                        <img src="{{ asset('storage/images/Bonface.jpeg') }}" alt="Instructor 1" class="w-24 h-24 object-cover rounded-full mx-auto mb-4 border-4 border-white">
                        <h3 class="text-xl font-semibold mb-2 text-black">Boniface Onduso</h3>
                        <p class="text-black">As a passionate and results-driven Software Engineer, I leverage my strong computer science background to develop scalable, full-stack web applications.</p>
                    </div>
                    <!-- Instructor 2 -->
                    <div class="instructor text-center p-6 bg-gradient-to-r from-blue-400 via-teal-500 to-green-500 rounded-lg shadow-lg transform transition-transform duration-500 hover:scale-105 hover:shadow-xl ">
                        <img src="{{ asset('storage/images/Sheila.jpeg') }}" alt="Instructor 2" class="w-24 h-24 object-cover rounded-full mx-auto mb-4 border-4 border-white">
                        <h3 class="text-xl font-semibold mb-2 text-black">Sheila Chebii</h3>
                        <p class="text-black">Specialist in Web Development and passionate about teaching new technologies.</p>
                    </div>
                </div>

                <!-- Centered Instructor -->
                <div class="flex items-center justify-center md:col-span-1">
                    <div class="instructor text-center p-6 bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 rounded-lg shadow-lg transform transition-transform duration-500 hover:scale-105 hover:shadow-xl ">
                        <img src="{{ asset('storage/images/Emmanuel.jpeg') }}" alt="Instructor 3" class="w-24 h-24 object-cover rounded-full mx-auto mb-4 border-4 border-white">
                        <h3 class="text-xl font-semibold mb-2 text-black">Emmanuel Kipkemboi</h3>
                        <p class="text-black">Experienced in Data Science and dedicated to helping students excel in their careers.</p>
                    </div>
                </div>

                <!-- Bottom Row: Full Width Instructors -->
                <div class="flex flex-col md:col-span-1 space-y-8">
                    <!-- Instructor 4 -->
                    <div class="instructor text-center p-6 bg-gradient-to-r from-green-400 via-teal-500 to-blue-500 rounded-lg shadow-lg transform transition-transform duration-500 hover:scale-105 hover:shadow-xl ">
                        <img src="{{ asset('storage/images/Paul.jpeg') }}" alt="Instructor 4" class="w-24 h-24 object-cover rounded-full mx-auto mb-4 border-4 border-white">
                        <h3 class="text-xl font-semibold mb-2 text-black">Paul Ruoya</h3>
                        <p class="text-black">Seasoned Software Engineer with expertise in backend systems and databases.</p>
                    </div>
                    <!-- Instructor 5 -->
                    <div class="instructor text-center p-6 bg-gradient-to-r from-red-400 via-orange-500 to-yellow-500 rounded-lg shadow-lg transform transition-transform duration-500 hover:scale-105 hover:shadow-xl ">
                        <img src="{{ asset('storage/images/Shadrack.jpeg') }}" alt="Instructor 5" class="w-24 h-24 object-cover rounded-full mx-auto mb-4 border-4 border-white">
                        <h3 class="text-xl font-semibold mb-2 text-black">Shadrack Onyango</h3>
                        <p class="text-black">Software Engineer with expertise in backend systems and databases.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="flex justify-center space-x-6 mt-12">
            <a href="https://facebook.com" target="_blank" class="text-gray-800 dark:text-gray-200 hover:text-yellow-500 transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                </svg>
            </a>
            <a href="https://chat.whatsapp.com/JOKvqC5s0wVDftvtFu5s7M" target="_blank" class="text-gray-800 dark:text-gray-200 hover:text-yellow-500 transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                    <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                </svg>
            </a>
            <a href="mailto:bonniecomputerhub24@gmail.com" target="_blank" class="text-gray-800 dark:text-gray-200 hover:text-yellow-500 transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                </svg>
            </a>
            <a href="https://instagram.com/bonniecomputerhub" target="_blank" class="text-gray-800 dark:text-gray-200 hover:text-yellow-500 transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                </svg>
            </a>
        </div>
        </div>
    </section>
    <!-- AOS Library Initialization -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>