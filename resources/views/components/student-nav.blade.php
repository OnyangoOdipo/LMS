<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('build/assets/output.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Student Dashboard</title>
</head>

<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="bg-gray-900 border-b border-gray-200 shadow-md">
    <div class="flex items-center justify-between max-w-screen-xl px-4 mx-auto py-4">
      <a href="#" class="flex items-center">
        <img src="{{ asset('build/assets/images/logo.jpeg')}}" class="h-8 mr-3 rounded-full" alt="Logo">
        <span class="text-xl font-semibold text-white">Bonnie Computer Hub</span>
      </a>
      <div class="flex items-center space-x-4">
        <button id="menu-btn" class="block md:hidden text-white focus:outline-none">
          <span class="material-icons">menu</span>
        </button>
        <div class="hidden md:flex space-x-4">
          <a href="{{ route('dashboard') }}" class="text-white hover:text-blue-800">Home</a>
          <a href="{{ route('quizzes.index') }}" class="text-white hover:text-blue-800">Quizzes</a>
          <a href="{{ route('assignments.index') }}" class="text-white hover:text-blue-800">Assignments</a>
          <a href="{{ route('announcements.index') }}" class="text-white hover:text-blue-800">Announcements</a>
          <a href="{{ route('progress.index') }}" class="text-white hover:text-blue-800">Progress</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-white hover:text-blue-800 focus:outline-none">
              <span class="material-icons">logout</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </nav>

  <div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="hidden md:flex flex-col w-64 bg-gray-900 text-white rounded-lg">
      <div class="flex items-center justify-center h-16 bg-blue-800 rounded-t-lg">
        <span class="font-bold uppercase text-center">Dashboard <br> Menu</span>
      </div>
      <nav class="flex-1 overflow-y-auto">
        <ul class="flex flex-col px-2 py-4">
          <li>
            <a href="#" class="flex items-center px-4 py-2 bg-gray-900 hover:bg-blue-600 rounded-lg my-1">
              <span class="material-icons mr-2">assessment</span>
              Study Report
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center px-4 py-2 bg-gray-900 hover:bg-blue-600 rounded-lg my-1">
              <span class="material-icons mr-2">book</span>
              Learning Content
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center px-4 py-2 bg-gray-900 hover:bg-blue-600 rounded-lg my-1">
              <span class="material-icons mr-2">inventory</span>
              Resources
            </a>
          </li>
          <li>
            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 bg-gray-900 hover:bg-blue-600 rounded-lg my-1">
              <span class="material-icons mr-2">person</span>
              Your Profile
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      @include('components.alert')
      {{ $slot }}
    </main>
  </div>

  <!-- Mobile Dropdown Links -->
  <div id="mobile-dropdown" class="hidden fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-4 w-80">
      <button id="close-dropdown" class="text-gray-700 float-right">✖</button>
      <div class="flex flex-col space-y-4 mt-4">
        <a href="{{ route('dashboard') }}" class="text-black hover:text-blue-800">Home</a>
        <a href="{{ route('quizzes.index') }}" class="text-black hover:text-blue-800">Quizzes</a>
        <a href="{{ route('assignments.index') }}" class="text-black hover:text-blue-800">Assignments</a>
        <a href="{{ route('announcements.index') }}" class="text-black hover:text-blue-800">Announcements</a>
        <a href="{{ route('progress.index') }}" class="text-black hover:text-blue-800">Progress</a>
        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profile</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-white hover:text-blue-800 focus:outline-none">
              <span class="material-icons">logout</span>
            </button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  
  <script>
    // Mobile Navbar Toggle
    const menuBtn = document.getElementById('menu-btn');
    const mobileDropdown = document.getElementById('mobile-dropdown');
    const closeDropdown = document.getElementById('close-dropdown');

    menuBtn.addEventListener('click', () => {
      mobileDropdown.classList.toggle('hidden');
    });

    closeDropdown.addEventListener('click', () => {
      mobileDropdown.classList.add('hidden');
    });

    // Close Mobile Dropdown if clicked outside
    document.addEventListener('click', function(event) {
      const isClickInside = menuBtn.contains(event.target) || mobileDropdown.contains(event.target);
      if (!isClickInside) {
        mobileDropdown.classList.add('hidden');
      }
    });
  </script>
</body>

</html>
