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
