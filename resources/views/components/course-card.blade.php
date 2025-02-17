<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cards</title>
    <link rel="stylesheet" href="{{ asset('css/course-card.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
    <!-- <div class="course-card">
        <h1>Urm</h1>
        <h3>{{ $course->name }}</h3>
        <p>{{ $course->description }}</p>

        @can('edit-course', $course)
            <form action="{{ route('edit_course', ['id' => $course->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit">Edit Course</button>
            </form>
            <form action="{{ route('delete_course', ['id' => $course->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete Course</button>
            </form>
        @endcan

        <a href="{{ route('show_course_info', $course->id) }}" class="btn btn-primary">
            Go to Course Info 
        </a>
    </div>

    <div class="max-w-sm rounded overflow-hidden shadow-lg">

        <img class="w-full" src="/img/card-top.jpg" alt="Sunset in the mountains">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
            <p class="text-gray-700 text-base">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
            </p>
        </div>
        <div class="px-6 pt-4 pb-2">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
        </div>
        <a href="{{ route('show_course_info', $course->id) }}" class="btn btn-primary">
            
        </a>
    </div> -->

    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        
        <img src="https://dummyimage.com/400x300/ddd/fff.png&text=Loading..." alt="Custom Placeholder">
        
        <div class="p-5">
            @can('edit-course', $course)
                <form action="{{ route('edit_course', ['id' => $course->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900">Yellow</button>
                </form>
                <form action="{{ route('delete_course', ['id' => $course->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
                </form>
            @endcan
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $course->name }}</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $course->description }}</p>
            <a href="{{ route('show_course_info', $course->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Course Info
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>
    </div>

    <script src="{{ asset('js/course-card.js') }}" defer></script>
</body>
</html>