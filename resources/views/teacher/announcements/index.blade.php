<x-teacher-nav>
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-6">Announcements</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Check if there are any announcements -->
        @if($announcements->isEmpty())
            <p class="text-gray-600">No announcements available.</p>
        @else
            <!-- Loop through the announcements -->
            @foreach ($announcements as $announcement)
                <div class="p-4 mb-4 rounded-lg shadow-md 
                            {{ $announcement->urgency == 'high' ? 'bg-red-100' : ($announcement->urgency == 'medium' ? 'bg-yellow-100' : 'bg-green-100') }}">
                    <h2 class="text-xl font-bold">{{ $announcement->title }}</h2>
                    <p class="mt-2 text-gray-800">{{ $announcement->message }}</p>

                    <div class="mt-4">
                        <!-- Urgency Display -->
                        <span class="text-sm font-semibold">
                            Urgency:
                            <span class="{{ $announcement->urgency == 'high' ? 'text-red-600' : ($announcement->urgency == 'medium' ? 'text-yellow-500' : 'text-green-600') }}">
                                {{ ucfirst($announcement->urgency) }}
                            </span>
                        </span>

                        <!-- Cohort Display -->
                        <span class="ml-6 text-sm font-semibold">
                            Cohort: 
                            <span class="text-gray-700">
                                Cohort {{ $announcement->cohort }}
                            </span>
                        </span>

                        <!-- Posted By -->
                        <span class="ml-6 text-sm font-semibold">
                            Posted by:
                            <span class="text-gray-700">
                                {{ $announcement->teacher ? $announcement->teacher->name : $announcement->admin->name }}
                            </span>
                        </span>

                        <!-- Posted Date -->
                        <span class="ml-6 text-sm text-gray-500">
                            {{ $announcement->created_at->format('M d, Y') }}
                        </span>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</x-teacher-nav>
