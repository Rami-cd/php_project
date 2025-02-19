<script src="https://cdn.tailwindcss.com"></script>

<div class="course-edit p-6 bg-white rounded-lg shadow-lg max-w-4xl mx-auto mt-8">
    <!-- Course Title -->
    <h1 class="text-3xl font-semibold text-gray-800 mb-4">Edit Course: {{ $course->name }}</h1>

    <!-- Course Description -->
    <p class="text-lg text-gray-600 mb-6">{{ $course->description }}</p>

    <!-- Modules Section -->
    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Modules</h3>
    <div class="module-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($modules as $module)
            <x-course-module-card :module="$module" />
        @endforeach
    </div>

    <!-- Add New Module Button (styled) -->
    <div class="mt-6">
    <a href="{{ route('module_creation_form', ['course' => $course->id]) }}" class="inline-block bg-blue-500 text-white font-semibold py-2 px-6 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200">
    Add New Module
</a>

    </div>
</div>
