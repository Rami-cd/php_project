<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Back to Main Button -->
                    <a href="{{ route('home') }}" class="mt-4 inline-block px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Back to Main
                    </a>

                    <!-- Box around the enrolled courses -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md mt-6">
                        <h3 class="text-lg font-semibold mb-4">Your Enrolled Courses</h3>
                        <ul>
                            @foreach (Auth::user()->enrollments()->paginate(10) as $course_enrollment)
                                <li class="mb-4">
                                    <x-user-course-progress :enrollment="$course_enrollment" :course="$course_enrollment->course" />
                                </li>
                            @endforeach
                        </ul>
                        {{ Auth::user()->enrollments()->paginate(10)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
