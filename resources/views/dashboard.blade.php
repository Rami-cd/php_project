<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @can('is-admin')
        <div>
            <a href="{{ route ("admin.dashboard") }}">Go to admin dashboard</a>
        </div>
    @endcan

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>Your Enrolled Courses</h3>
                    <ul>
                        @foreach (Auth::user()->enrollments()->paginate(10) as $course_enrollment)
                            <li>
                                <x-user-course-progress :enrollment="$course_enrollment" :course="$course_enrollment->course" />
                            </li>
                            {{ Auth::user()->enrollments()->paginate(10)->links() }}
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
