<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Users Management</h1>

        <!-- Search and Filter -->
        <form method="GET" class="flex flex-wrap items-center mb-6 space-x-4 space-y-4 sm:space-y-0">
            <input type="text" name="search" placeholder="Search by username or email" class="w-full sm:w-64 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request('search') }}">

            <select name="role" class="w-full sm:w-48 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">All Roles</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student</option>
            </select>

            <!-- Radio buttons for search type -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center">
                    <input class="form-radio text-blue-600" type="radio" name="search_type" value="username" 
                        {{ request('search_type', 'username') == 'username' ? 'checked' : '' }} id="searchUsername">
                    <label class="ml-2 text-sm text-gray-600" for="searchUsername">Username</label>
                </div>
                <div class="flex items-center">
                    <input class="form-radio text-blue-600" type="radio" name="search_type" value="email" 
                        {{ request('search_type') == 'email' ? 'checked' : '' }} id="searchEmail">
                    <label class="ml-2 text-sm text-gray-600" for="searchEmail">Gmail Only</label>
                </div>
            </div>

            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">Search</button>
        </form>

        <!-- Users List -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium">Username</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Roles</th>
                        <th class="px-6 py-3 text-center text-sm font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($users as $user)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-3 text-sm">{{ $user->username }}</td>
                            <td class="px-6 py-3 text-sm">{{ $user->name }}</td>
                            <td class="px-6 py-3 text-sm">{{ $user->email }}</td>
                            <td class="px-6 py-3 text-sm">{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
                            <td class="px-6 py-3 text-center">
                                <a href="{{ route('admin.users.roles', $user) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-200 text-sm">Manage Roles</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links('vendor.pagination.tailwind') }}
        </div>
    </div>

</body>
</html>
