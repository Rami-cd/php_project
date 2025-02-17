<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">
    @foreach ($courses as $course)
        <x-course-card :course="$course" class="m-2" /> 
    @endforeach
</div>

<div class="mt-8 mb-8 flex justify-center">
    {{ $courses->links('vendor.pagination.tailwind') }}
</div>
