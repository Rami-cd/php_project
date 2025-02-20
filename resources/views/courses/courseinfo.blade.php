<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Info</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>
<body class="bg-gray-100">
    <div class="flex justify-center items-center min-h-screen px-4">
        <div class="bg-white w-full max-w-7xl p-6 rounded-lg shadow-xl">
            <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Course Info</h1>

            <!-- Course Information Section -->
            <div class="bg-gray-50 p-6 rounded-lg mb-8">
                <h2 class="text-2xl font-bold text-gray-800">{{ $course->name }}</h2>
                <p class="text-gray-600 mt-2 text-lg">{{ $course->description }}</p>
            </div>

            <!-- Course Creators Section -->
            @if($course->users && $course->users->isNotEmpty())
                <div class="bg-white p-6 rounded-lg shadow-md mt-6 border border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Course Creators</h3>
                    
                    <!-- Scrollable Creators List -->
                    <div class="space-y-4 max-h-80 overflow-y-auto">
                        @foreach ($course->users as $creator)
                            <div class="flex items-center space-x-4">
                                <img src="{{ $creator->profile_image ? Storage::url($creator->profile_image) : 'https://ui-avatars.com/api/?name=' . urlencode($creator->name) . '&background=random&color=fff' }}"
                                    alt="Creator Profile"
                                    class="w-16 h-16 rounded-full object-cover border border-gray-300">

                                <div>
                                    <h4 class="text-xl font-bold text-gray-800">{{ $creator->name }}</h4>
                                    <p class="text-gray-600 text-sm">{{ $creator->email }}</p>
                                    <p class="text-gray-500 text-sm mt-1">Joined: {{ $creator->created_at->format('F Y') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="text-center text-gray-500">No creators available for this course.</p>
            @endif

            @can('enrolled-in-course', $course)
            <form action="{{ route('course.rate', $course->id) }}" method="POST">
                @csrf
                <label for="rating">Rate this Course:</label>
                <select name="rating" id="rating" required>
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white p-2 mt-2">Submit Rating</button>
            </form>
            @endcan

            <!-- Enroll / Unenroll Button -->
            @auth
                @can('enrolled-in-course', $course)
                    <!-- If the user is already enrolled, show Unenroll button -->
                    <form action="{{ route('courses.unenroll', $course->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Unenroll</button>
                    </form>
                @else
                    <!-- If the user is not enrolled, show Enroll button -->
                    <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Enroll Now</button>
                    </form>
                @endcan
            @endauth

            <!-- Module List and Video Section -->
            <div x-data="{ currentModule: null }" class="flex mt-8">
                <!-- Module List (Left side) -->
                <div class="w-1/4 bg-gray-100 p-4 rounded-lg mr-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Modules</h2>
                    <div class="space-y-4">
                        @foreach ($modules as $module)
                            <div @click="currentModule = currentModule === {{ $module->id }} ? null : {{ $module->id }}" 
                                class="cursor-pointer hover:bg-blue-100 p-2 rounded">
                                <h3 class="text-lg font-medium text-gray-800">{{ $module->name }}</h3>
                            </div>
                        @endforeach
                    </div>
                </div>

                @can('enrolled-in-course', $course)
                <!-- Video Section (Right side) -->
                <div class="w-3/4">
                    @foreach ($modules as $module)
                        <!-- Video Component -->
                        <div x-show="currentModule === {{ $module->id }}" x-transition>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-4">{{ $module->name }} Video</h3>
                            <video class="w-full rounded-lg" controls>
                                <source src="{{ Storage::url($module->course_url) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endforeach
                </div>
                @endcan
            </div>
        </div>
    </div>
</body>
</html>
