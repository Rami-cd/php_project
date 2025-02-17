<div class="max-w-sm mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
  <!-- Card Header -->
  <div class="relative">
    <img class="w-full h-48 object-cover" src="{{ asset($course->thumbnail_url) }}" alt="Course Thumbnail">
    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black via-transparent to-transparent">
      <h2 class="text-2xl font-semibold text-white">{{ $course->name }}</h2>
    </div>
  </div>

  <!-- Card Body -->
  <div class="p-4">
    <p class="text-gray-700 text-base mb-4">{{ $course->description }}</p>


  <!-- Footer with action button -->
  <div class="p-4 bg-gray-100">
    <button class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
      Continue Learning
    </button>
  </div>
</div>
