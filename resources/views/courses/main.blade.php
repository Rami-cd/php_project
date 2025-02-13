<div>
    @foreach ($courses as $course)
        <x-course-card :course="$course" class="course-card" />
    @endforeach
</div>