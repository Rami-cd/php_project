<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses Management</title>
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Courses Management</h1>

        <!-- Search and Filter -->
        <form method="GET" class="flex flex-wrap items-center mb-6 space-x-4 space-y-4 sm:space-y-0">
            <input type="text" name="search" placeholder="Search by course title" class="w-full sm:w-64 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request('search') }}">

            <select name="status" class="w-full sm:w-48 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">All Statuses</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>

            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">Search</button>
        </form>

        <!-- Courses List -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium">Title</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                        <th class="px-6 py-3 text-center text-sm font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($courses as $course)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-3 text-sm">{{ $course->name }}</td>
                            <td class="px-6 py-3 text-sm">
                                @if($course->status == 'published')
                                    <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-xs">Published</span>
                                @else
                                    <span class="bg-yellow-200 text-yellow-800 px-3 py-1 rounded-full text-xs">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-center">
                                <form action="{{ route('edit_course', ['id' => $course->id]) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 text-sm">Edit Course</button>
                                </form>

                                <form action="{{ route('admin.courses.delete', $course->id) }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-200 text-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $courses->links('vendor.pagination.tailwind') }}
        </div>
    </div>

</body>
</html>
