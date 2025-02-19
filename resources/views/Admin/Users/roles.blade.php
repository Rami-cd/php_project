<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Roles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="container bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Manage Roles for {{ $user->name }}</h2>

        <form method="POST" action="{{ route('admin.users.roles.update', $user) }}">
            @csrf

            <div class="mb-6">
                <label class="block text-lg font-medium text-gray-700">Select Roles:</label>
                <div class="mt-4 space-y-4">
                    @foreach($roles as $role)
                        <div class="flex items-center">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 border-gray-300 rounded" name="roles[]" value="{{ $role->name }}"
                                {{ in_array($role->name, $userRoles) ? 'checked' : '' }}>
                            <label class="ml-2 text-gray-800 text-sm">{{ ucfirst($role->name) }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 focus:outline-none">Update Roles</button>
                <a href="{{ route('admin.users.index') }}" class="w-full bg-gray-200 text-gray-700 py-2 rounded-lg hover:bg-gray-300 focus:outline-none text-center flex items-center justify-center">Cancel</a>
            </div>
        </form>
    </div>

</body>
</html>
