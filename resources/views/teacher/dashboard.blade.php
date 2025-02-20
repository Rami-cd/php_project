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

                    <form method="GET" action="{{ route('teacher.dashboard') }}" class="flex flex-col md:flex-row gap-2 md:gap-4 items-center bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
    <!-- Search Input -->
    <div class="w-full md:w-auto flex-1">
        <input type="text" name="search" placeholder="Search courses..." class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request('search') }}">
    </div>

    <!-- Status Dropdown -->
    <div class="w-full md:w-auto">
        <select name="status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">All Statuses</option>
            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-300">
        🔍 Search
    </button>
</form>



                    <ul>
                        <!-- Display Paginated Courses -->
                        @foreach ($courses as $course)
                            <li class="mb-4">
                                <x-course-card :course="$course" />
                            </li>
                        @endforeach
                    </ul>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $courses->links() }}
                    </div>

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
                                @if($course->user_enrolled_courses)
                                    <h4 class="text-lg font-semibold">Course: {{ $course->name }}</h4>
                                    <h2>Students: </h2>
                                    <ul>
                                        @foreach ($course->user_enrolled_courses as $student)
                                            <li>{{ $student->name }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
