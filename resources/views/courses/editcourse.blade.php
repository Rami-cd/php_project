
<div class="course-edit">
    <h1>Edit Course: {{ $course->name }}</h1>
    <p>{{ $course->description }}</p>

    <h3>Modules</h3>
    <div class="module-list">
        @foreach ($modules as $module)
            <x-course-module-card :module="$module" />
        @endforeach
    </div>
</div>
