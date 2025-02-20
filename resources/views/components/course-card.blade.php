<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <img src="{{ asset('storage/' . $course->thumbnail_url) }}" alt="Course Thumbnail" class="w-full h-48 object-cover">
    <div class="p-5">
        @can('edit-course', $course)
            <form action="{{ route('edit_course', ['id' => $course->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900">Edit</button>
            </form>
            <form action="{{ route('delete_course', ['id' => $course->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
            </form>
        @endcan

        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $course->name }}</h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 max-h-32 overflow-y-auto">{{ $course->description }}</p>

        <!-- Rating and Review Component -->
        <div class="flex items-center mt-2 mb-3">
            <!-- Star Rating SVG -->
            @php
                $rating = $course->average_rating ? round($course->average_rating, 1) : 0;
            @endphp
            <div class="flex items-center">
                @for ($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= $rating ? 'text-yellow-300' : 'text-gray-300' }} me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                @endfor
            </div>
            
            <!-- Rating Number -->
            <p class="ms-2 text-sm font-bold text-gray-900 dark:text-white">{{ $rating }}</p>

            <!-- Separator -->
            <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>

            <!-- Review Count Link -->
            <a href="#" class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white">
                {{ $course->ratings_count }} reviews
            </a>
        </div>

        <a href="{{ route('show_course_info', $course->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Course Info
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>
    </div>
</div>
