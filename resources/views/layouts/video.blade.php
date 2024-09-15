<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'BCH Online Class') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div>
                    <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-700">
                        {{ config('app.name', 'BCH Online Class') }}
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-500">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-blue-500">Profile</a>
                    <a href="{{ route('logout') }}" class="text-gray-600 hover:text-red-500">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto py-10 px-6">
        <h1 class="text-3xl font-bold text-center text-blue-600 mb-8">@yield('title', 'BCH Online Class')</h1>

        <div class="bg-white rounded-lg shadow-lg p-6">
            {{-- Content from the extending blade will be rendered here --}}
            @yield('content')
        </div>
    </div>

    {{-- Include any necessary scripts --}}
    @stack('scripts')

</body>
</html>
