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
      @include('components.alert')
        {{ $slot }}
    </main>
  </div>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</body>
</html>