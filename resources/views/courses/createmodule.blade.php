<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Module</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Module Creation</h1>

        <form action="{{ route('create_module') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Module Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded-lg p-2 mt-1">
                @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block font-medium">Description</label>
                <textarea name="description" class="w-full border rounded-lg p-2 mt-1">{{ old('description') }}</textarea>
                @error('description') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block font-medium">Order</label>
                <input type="text" name="order" value="{{ old('order') }}" class="w-full border rounded-lg p-2 mt-1">
                @error('order') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block font-medium">Module URL</label>
                <input type="file" name="module_url" class="w-full border rounded-lg p-2 mt-1">
                @error('module_url') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <input type="hidden" name="course_id" value="{{ $course->id }}">

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                Create Module
            </button>
        </form>

        <!-- Back Button to Main Page -->
        <a href="{{ route('dashboard') }}" class="mt-6 block text-center text-blue-600 hover:text-blue-800">
            <button class="w-full bg-gray-200 text-gray-700 py-2 rounded-lg hover:bg-gray-300 focus:outline-none">
                Back to Dashboard
            </button>
        </a>
    </div>

</body>
</html>
