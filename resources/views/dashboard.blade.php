<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('build/assets/output.css') }}">
  <title>Student Dashboard</title>
</head>

<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="bg-gray-900 border-b border-gray-200 shadow-md">
    <div class="flex items-center justify-between max-w-screen-xl px-4 mx-auto py-4">
      <a href="#" class="flex items-center">
        <img src="{{ asset('storage/images/logo.jpeg')}}" class="h-8 mr-3 rounded-full" alt="Logo">
        <span class="text-xl font-semibold text-white">Bonnie Computer Hub</span>
      </a>
      <div class="flex space-x-4">
        <a href="#" class="text-white hover:text-blue-800">Home</a>
        <a href="{{ route('quizzes.index') }}" class="text-white hover:text-blue-800">Quizzes</a>
        <a href="#" class="text-white hover:text-blue-800">Assignments</a>
        <a href="#" class="text-white hover:text-blue-800">Announcements</a>
        <a href="#" class="text-white hover:text-blue-800">Progress</a>
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
            <a href="#" class="flex items-center px-4 py-2 bg-gray-900 hover:bg-blue-600 rounded-lg my-1">
              <span class="material-icons mr-2">person</span>
              Your Profile
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <h1 class="text-3xl font-bold text-blue-900">Welcome to the Student Dashboard</h1>
      @include('components.alert')

      <!-- Dashboard Cards -->
      <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2 lg:grid-cols-3">
        <div class="bg-white p-4 rounded-lg shadow">
          <h2 class="font-semibold text-lg text-blue-900">Current Score</h2>
          <p class="text-3xl font-bold">45</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
          <h2 class="font-semibold text-lg text-blue-900">Pending Assignments</h2>
          <p class="text-3xl font-bold">12</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
          <h2 class="font-semibold text-lg text-blue-900">Quizzes</h2>
          <p class="text-3xl font-bold">5</p>
        </div>
      </div>

      <!-- Quizzes, Assignments, Announcements Section -->
      <div class="mt-6">
    <h2 class="text-2xl font-semibold text-blue-900">Quizzes, Assignments, and Announcements</h2>
    <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2 lg:grid-cols-3">
        <!-- Quizzes Section -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="font-semibold">Quizzes</h3>
            <p>Upcoming: {{ $quizzes->count() }} quizzes</p>
            @if ($quizzes->count())
                <p>Next quiz due in {{ $quizzes->first()->due_in_days }} days</p>
            @else
                <p>No upcoming quizzes.</p>
            @endif
        </div>

        <!-- Assignments Section -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="font-semibold">Assignments</h3>
            <p>Pending: {{ $assignments->count() }} assignments</p>
            @if ($assignments->count())
                <p>Next assignment due in {{ $assignments->first()->due_in_days }} days</p>
            @else
                <p>No pending assignments.</p>
            @endif
        </div>

        <!-- Announcements Section -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="font-semibold">Announcements</h3>
            @if ($announcements->count())
                <p>Latest: {{ $announcements->first()->message }}</p>
            @else
                <p>No announcements.</p>
            @endif
        </div>
    </div>
</div>

    </main>
  </div>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</body>

</html>