<x-student-nav>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Progress Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-2">Quizzes</h2>
                    <p class="text-gray-700">Total Quizzes Issued: <span class="font-bold">{{ $totalQuizzes }}</span></p>
                    <p class="text-gray-700">Completed Quizzes: <span class="font-bold">{{ $completedQuizzes }}</span></p>
                </div>

                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-2">Assignments</h2>
                    <p class="text-gray-700">Total Assignments Issued: <span class="font-bold">{{ $totalAssignments }}</span></p>
                    <p class="text-gray-700">Completed Assignments: <span class="font-bold">{{ $completedAssignments }}</span></p>
                </div>

                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-2">Overall Progress</h2>
                    <p class="text-gray-700">Total Score: <span class="font-bold">{{ $totalScore }}</span></p>
                    <p class="text-gray-700">Percentage Progress: <span class="font-bold">{{ round($percentageProgress, 2) }}%</span></p>
                </div>
            </div>

            <div>
                <canvas id="progressChart" class="mt-6"></canvas>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('progressChart').getContext('2d');
        const progressChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completed Quizzes', 'Remaining Quizzes', 'Completed Assignments', 'Remaining Assignments'],
                datasets: [{
                    data: [
                        {{ $completedQuizzes }},
                        {{ $totalQuizzes - $completedQuizzes }},
                        {{ $completedAssignments }},
                        {{ $totalAssignments - $completedAssignments }}
                    ],
                    backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });
    </script>
</x-student-nav>