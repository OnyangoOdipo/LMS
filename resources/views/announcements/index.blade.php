<x-student-nav>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-blue-900 mb-6">Announcements</h2>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($announcements->isEmpty())
            <p class="text-gray-600">No announcements available at the moment.</p>
        @else
            <div class="space-y-4">
                @foreach($announcements as $announcement)
                    @php
                        // Set background color based on urgency
                        $urgencyColors = [
                            'low' => 'bg-blue-100 text-blue-800',
                            'medium' => 'bg-yellow-100 text-yellow-800',
                            'high' => 'bg-red-100 text-red-800',
                        ];
                    @endphp

                    <div class="rounded-lg shadow p-4 {{ $urgencyColors[$announcement->urgency] }}">
                        <h3 class="text-lg font-bold">{{ $announcement->title }}</h3>
                        <p class="text-sm text-gray-700">{{ $announcement->message }}</p>

                        <div class="flex justify-between items-center mt-4">
                            <span class="text-xs text-gray-500">Recipient: 
                                @if($announcement->recipient_type == 'everyone')
                                    Everyone
                                @elseif($announcement->recipient_type == 'cohort_1')
                                    Cohort 1
                                @else
                                    Cohort 2
                                @endif
                            </span>
                            <span class="text-xs text-gray-500">Urgency: {{ ucfirst($announcement->urgency) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-student-nav>
