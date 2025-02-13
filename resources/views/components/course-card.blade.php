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
    
    <div class="course-card">
        <h1>Urm</h1>
        <h3>{{ $course->name }}</h3>
        <p>{{ $course->description }}</p>

        <!-- only display the edit course if the user pass the gate test -->
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

    <script src="{{ asset('js/course-card.js') }}" defer></script>
</body>
</html>