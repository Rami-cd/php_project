<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-md">
                    New Header Action
                </button>
            </div>
        </div>
    </x-slot>

    <!-- @can('is-admin')
        <a href="{{ route ("admin.dashboard") }}">Go to admin dashboard< 
            <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                <p class="font-bold">Admin account</p>
                <p class="text-sm">Click to go to admin dashboard</p>
            </div>
        </a>
    @endcan -->

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
                        @endforeach
                    </ul>
                    {{ Auth::user()->enrollments()->paginate(10)->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
