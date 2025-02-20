<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900">


    <div class="container mx-auto py-12 px-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-8">
        <div class="shrink-0 flex items-center">
    <a href="{{ route('home') }}">
        <img src="{{ asset('storage/uploads/logo-transparent.png') }}" alt="Custom Logo" class="block h-16 w-auto">
    </a>
</div>
            <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200">Student Dashboard</h2>
        </div>

        <!-- Main Content -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <!-- Back to Main Button -->
                <a href="{{ route('home') }}" class="inline-block px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 mb-6">
                    Back to Main
                </a>

                <!-- Box around the enrolled courses -->
                <div class="space-y-8">
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-200">Your Enrolled Courses</h3>

                    <!-- Course Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach (Auth::user()->enrollments()->paginate(10) as $course_enrollment)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center">
                                <!-- Course Title and Description -->
                                <div class="flex flex-col items-center text-center space-y-4 mb-6">
                                    <div class="text-xl font-semibold text-gray-900 dark:text-gray-200">
                                        {{ $course_enrollment->course->title }}
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        {{ Str::limit($course_enrollment->course->description, 100) }}
                                    </p>
                                    <x-user-course-progress :enrollment="$course_enrollment" :course="$course_enrollment->course" />
                                </div>

                                <!-- Donut Chart for Progress -->
                                <div class="w-full max-w-xs h-48 bg-gray-100 dark:bg-gray-700 rounded-lg p-4 shadow-md">
                                    <canvas id="progressChart-{{ $course_enrollment->id }}" width="300" height="300"></canvas>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 flex justify-center">
                        {{ Auth::user()->enrollments()->paginate(10)->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @foreach (Auth::user()->enrollments()->paginate(10) as $course_enrollment)
                const ctx_{{ $course_enrollment->id }} = document.getElementById('progressChart-{{ $course_enrollment->id }}').getContext('2d');
                new Chart(ctx_{{ $course_enrollment->id }}, {
                    type: 'doughnut',
                    data: {
                        labels: ['Completed', 'Remaining'],
                        datasets: [{
                            data: [
                                {{ $course_enrollment->pourcentage }}, // Completed percentage
                                {{ 100 - $course_enrollment->pourcentage }} // Remaining percentage
                            ],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.8)', // Completed color
                                'rgba(255, 99, 132, 0.8)'  // Remaining color
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)', // Completed border color
                                'rgba(255, 99, 132, 1)'  // Remaining border color
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: '{{ request()->has('dark') ? '#fff' : '#000' }}' // Dynamic legend color for dark/light mode
                                }
                            },
                            tooltip: {
                                enabled: true,
                                callbacks: {
                                    label: function (context) {
                                        return `${context.label}: ${context.raw}%`;
                                    }
                                }
                            }
                        }
                    }
                });
            @endforeach
        });
    </script>
</body>
</html>
