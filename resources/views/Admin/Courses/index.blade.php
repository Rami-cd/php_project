<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Courses Management</h1>

        <!-- Search and Filter -->
        <form method="GET" class="d-flex mb-3">
            <input type="text" name="search" placeholder="Search by course title" class="form-control mr-2" value="{{ request('search') }}">
            <select name="status" class="form-control mr-2">
                <option value="">All Statuses</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            <button type="submit" class="btn btn-success">Search</button>
        </form>

        <!-- Courses List -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td></td>
                        <td>
                            <form action="{{ route('edit_course', ['id' => $course->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit">Edit Course</button>
                            </form>
                            <form action="{{ route('admin.courses.delete', $course->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $courses->links() }}
    </div>
</body>
</html>