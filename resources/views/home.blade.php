<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Module</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<header class="bg-white shadow-md py-4">
    <div class="max-w-screen-xl mx-auto flex justify-between items-center px-4">
        <!-- Logo (Optional) -->
        <div class="text-lg font-bold text-gray-800">
            <a href="/">Logo</a>
        </div>

        <!-- Search Form -->
        <form id="search-form" method="GET" class="max-w-lg mx-auto">
        <div class="w-full max-w-sm min-w-[200px]">
            <div class="relative mt-2">
                <div class="absolute top-1 left-1 flex items-center">
                    <button id="dropdownButton" class="rounded border border-transparent py-1 px-1.5 text-center flex items-center text-sm transition-all text-slate-600">
                        <span id="dropdownSpan" class="text-ellipsis overflow-hidden">Categry</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div class="h-6 border-l border-slate-200 ml-1"></div>
                    <div id="dropdownMenu" class="min-w-[150px] overflow-hidden absolute left-0 w-full mt-10 hidden w-full bg-white border border-slate-200 rounded-md shadow-lg z-10">
                        <ul id="dropdownOptions">
                            @foreach ($categories as $category)
                                <li class="px-4 py-2 text-slate-600 hover:bg-slate-50 text-sm cursor-pointer" data-value="{{ $category->name }}" data-id="{{ $category->id }}">
                                    {{ $category->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- Search Input -->
                <input
                    type="text"
                    name="search_term"
                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                    placeholder="Search courses..."
                    value="{{ request('search_term') }}" />
                <input type="hidden" name="category_id" id="category_id" value="{{ request('category_id') }}">
                <button type="submit"
                    class="absolute top-1 right-1 flex items-center rounded bg-sky-500 py-1 px-2.5 border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow focus:bg-sky-400 focus:shadow-none active:bg-sky-400 hover:bg-sky-400 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 mr-1.5">
                        <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                    </svg>
                    Search
                </button>
            </div>
        </div>
    </form>

        <!-- Action Buttons -->
        <div class="flex space-x-4">
            @guest
                <a href="{{ route('register') }}">
                    <button class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-br from-cyan-500 to-blue-500 rounded-md hover:bg-transparent hover:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200">
                        Sign Up
                    </button>
                </a>

                <a href="{{ route('login') }}">
                    <button class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-br from-cyan-500 to-blue-500 rounded-md hover:bg-transparent hover:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200">
                        Login
                    </button>
                </a>
            @else
                <!-- Teacher Request Button -->
                @php
                    $userRequest = Auth::user()->teacherRequest;
                @endphp

                @cannot('is-teacher')
                    @if($userRequest && $userRequest->status === 'pending')
                        <button class="bg-gray-300 text-gray-600 font-semibold py-2 px-4 border border-gray-400 rounded cursor-not-allowed" disabled>
                            Awaiting Approval
                        </button>
                    @else
                        <a href="{{ route('become.teacher.form') }}">
                            <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                Teach on The Platform
                            </button>
                        </a>
                    @endif
                @endcan

                @can('is-teacher')
                    <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                        Create Course
                    </button>
                @endcan

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-br from-cyan-500 to-blue-500 rounded-md hover:bg-transparent hover:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200">
                        Logout
                    </button>
                </form>
            @endguest
        </div>
    </div>
</header>

<div id="courses-section">
    @include('courses.main', ['courses' => $courses])
</div>

<script>
    // Handle the dropdown for category selection
    document.getElementById('dropdownButton').addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent the click from propagating to the document
        var dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('hidden');
    });

    // Prevent opening the dropdown with Enter key
    document.getElementById('dropdownButton').addEventListener('keydown', function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Prevent the default action of the Enter key
        }
    });

    // Prevent Enter key from triggering dropdown button behavior
    document.getElementById('dropdownButton').addEventListener('focus', function() {
        document.getElementById('dropdownButton').addEventListener('keydown', function(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent Enter from opening the dropdown
            }
        });
    });

    // Handle category selection from the dropdown menu
    document.getElementById('dropdownOptions').addEventListener('click', function(event) {
        if (event.target.tagName === 'LI') {
            const categoryId = event.target.getAttribute('data-id');
            const categoryName = event.target.getAttribute('data-value');
            document.getElementById('dropdownSpan').textContent = categoryName;
            document.getElementById('category_id').value = categoryId;
            document.getElementById('dropdownMenu').classList.add('hidden');
        }
    });

    // Close the dropdown if user clicks anywhere outside of it
    document.addEventListener('click', function(event) {
        var dropdownMenu = document.getElementById('dropdownMenu');
        var dropdownButton = document.getElementById('dropdownButton');

        // Check if the click was outside the dropdown or the button
        if (!dropdownMenu.contains(event.target) && event.target !== dropdownButton) {
            dropdownMenu.classList.add('hidden');
        }
    });

    // Handle form submission using AJAX
    $('#search-form').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        var formData = $(this).serialize(); // Serialize the form data

        // Send AJAX request
        $.ajax({
            url: '{{ route("home.search") }}',
            type: 'GET',
            data: formData,
            success: function(response) {
                // Update the courses section with the new results
                $('#courses-section').html(response);
            },
            error: function() {
                alert('There was an error with the search.');
            }
        });
    });
</script>


</body>
</html>
