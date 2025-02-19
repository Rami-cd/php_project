<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Teacher Dashboard') }}
        </h2>
    </x-slot>

    <!-- Teacher-specific content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Teacher's Course Management -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>Your Courses</h3>
                    <ul>
                        @foreach (Auth::user()->courses as $course)
                            <li class="mb-4">
                                <x-course-card :course="$course" />
                            </li>
                        @endforeach
                    </ul>

                    <!-- Button to Create a New Course -->
                    <a href="{{ route('course_creation_form') }}" class="bg-blue-500 text-white p-2 rounded-md mt-4 inline-block">
                        Create New Course
                    </a>
                </div>
            </div>

            <!-- Enrolled Students in Courses -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>Your Students</h3>
                    <ul>
                        @foreach (Auth::user()->courses as $course)
                            <li>
                                <h4 class="text-lg font-semibold">{{ $course->name }}</h4>
                                <ul>
                                    @foreach ($course->user_enrolled_courses as $student)
                                        <li>{{ $student->name }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
