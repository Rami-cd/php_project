<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- TailwindCSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Navbar -->
    <header class="bg-white shadow-md py-4">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('storage/uploads/logo-transparent.png') }}" alt="Custom Logo" class="h-16 w-auto">
                </a>
            </div>
            <h1 class="text-2xl font-semibold text-gray-900">Admin Dashboard</h1>
        </div>
    </header>

    <main class="mt-10 max-w-7xl mx-auto px-4 mg-">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Manage Users Button -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 ease-in-out">
                <a href="{{ route('admin.users.index') }}" class="text-center block py-3 px-6 bg-blue-600 text-white rounded-lg font-semibold text-lg hover:bg-blue-700 transition duration-200">Manage Users</a>
            </div>
            <!-- Manage Courses Button -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 ease-in-out">
                <a href="{{ route('admin.courses.index') }}" class="text-center block py-3 px-6 bg-green-600 text-white rounded-lg font-semibold text-lg hover:bg-green-700 transition duration-200">Manage Courses</a>
            </div>
        </div>

        <!-- Teacher Request Section -->
        @include('admin.teacher_request', ["requests" => $requests])
    </main>

</body>
</html>
