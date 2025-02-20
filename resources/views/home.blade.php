<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Module</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-50">

<header class="bg-white shadow-md py-4">
    <div class="max-w-screen-xl mx-auto flex justify-between items-center px-4">
        <!-- Logo -->
        <div class="text-lg font-bold text-gray-800">
            <img src="{{ asset('storage/uploads/logo-transparent.png') }}" alt="logo" class="w-20 h-auto">
        </div>

        <form method="GET" action="{{ route('courses.search') }}" class="w-3xl max-w-2xl mx-auto">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input type="search" id="default-search" name="search_term" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search courses..." value="{{ request('search_term') }}" required />
        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
    </div>
</form>


        <!-- Action Buttons -->
        <div class="flex space-x-4 items-center">
            @guest
                <a href="{{ route('register') }}">
                    <button class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-br from-cyan-500 to-blue-500 rounded-md shadow-md hover:bg-transparent hover:text-white">
                        Sign Up
                    </button>
                </a>
                <a href="{{ route('login') }}">
                    <button class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-br from-cyan-500 to-blue-500 rounded-md shadow-md hover:bg-transparent hover:text-white">
                        Login
                    </button>
                </a>
            @else
            @cannot('is-teacher')
                <a href="{{ route('become.teacher.form') }}">
                <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                    Teach on The Platform
                </button>
</a>
            @endcan
            @can('is-teacher')
            <a href="{{ route('course_creation_form') }}">


            
                <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                    Create Course
                </button>
                </a>
            @endcan
                <a href="{{ route('dashboard') }}">
                    <button class="bg-transparent border border-green-500 text-green-700 font-semibold py-2 px-4 rounded-md hover:bg-green-500 hover:text-white shadow-md">
                        Dashboard
                    </button>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-br from-cyan-500 to-blue-500 rounded-md shadow-md hover:bg-transparent hover:text-white">
                        Logout
                    </button>
                </form>
            @endguest

            @auth
                <a href="{{ route('profile.show') }}">
                    <img src="{{ Auth::user()->image_url }}"
                        onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username) }}&background=random&color=fff';"
                        alt="Profile Image"
                        class="w-10 h-10 rounded-full object-cover border border-gray-300">
                </a>
            @endauth
        </div>
    </div>
</header>

<!-- Courses Section -->
<section id="courses-section" class="max-w-screen-xl mx-auto my-10 px-4">
    <h1 class="text-4xl font-extrabold text-gray-900 text-center mb-6">📚 Explore Our Courses</h1>
    <p class="text-lg text-gray-600 text-center mb-8">
        Find the best courses to enhance your skills and knowledge.
    </p>
    <div class="bg-white shadow-md rounded-lg p-6">
        @include('courses.main', ['courses' => $courses])
    </div>
</section>

<section id="teacher-section" class="max-w-screen-xl mx-auto my-10 px-4">
    <h1 class="text-4xl font-extrabold text-gray-900 text-center mb-6">🎓 Meet Our Top Teachers</h1>
    <p class="text-lg text-gray-600 text-center mb-8">
        Learn from the best educators with top ratings and experience.
    </p>

    <!-- Teacher Search Form -->
    <form id="teacher-search-form" class="max-w-lg mx-auto mb-6">
        <div class="relative">
            <input type="text" id="teacher-search-input" name="search_term"
                class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-gray-700 text-sm shadow-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Search teachers by name or email..." />
            <button type="submit"
                class="absolute top-1 right-1 bg-blue-500 text-white py-1.5 px-3 rounded-md text-sm shadow-md hover:bg-blue-600 transition">
                Search
            </button>
        </div>
    </form>

    <div class="bg-white shadow-md rounded-lg p-6" id="teacher-list">
        @include('partials.teacher_list', ['teachers' => $teachers])
    </div>
</section>



</body>

<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    $("#teacher-search-form").on("submit", function(event) {
        event.preventDefault(); // Prevent page reload

        let searchTerm = $("#teacher-search-input").val();

        console.log(searchTerm);

        $.ajax({
            url: "{{ route('teachers.search') }}",
            type: "GET",
            data: { search_term: searchTerm },
            success: function(response) {
                console.log(response);
                if (response.teachers) {
                    $("#teacher-list").html(response.teachers); // Ensure correct content update
                } else {
                    $("#teacher-list").html('<p class="text-gray-600">No teachers found.</p>');
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert("An error occurred. Please try again.");
            }
        });
    });
});
</script>


</html>
