<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-4 text-center">Create a Course</h1>
        
        <form action="{{ route('create_course') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold">Course Name</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">
                @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block font-semibold">Description</label>
                <textarea name="description" class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300">{{ old('description') }}</textarea>
                @error('description') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block font-semibold">Thumbnail</label>
                <input type="file" name="thumbnail_url" class="w-full border p-2 rounded-lg">
                @error('thumbnail_url') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div>
                <label class="block font-semibold">Course Creators</label>
                <div id="creators-container">
                    <input type="text" name="creators[]" placeholder="Enter creator name"
                        class="w-full p-2 border rounded-lg mb-2 focus:ring focus:ring-blue-300">
                </div>
                <button type="button" id="add-creator-btn" 
                    class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Add Creator</button>
            </div>

            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">
                Create Course
            </button>
        </form>
    </div>

    <script>
        document.getElementById('add-creator-btn').addEventListener('click', function() {
            const container = document.getElementById('creators-container');
            const newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'creators[]';
            newInput.placeholder = 'Enter creator name';
            newInput.className = 'w-full p-2 border rounded-lg mb-2 focus:ring focus:ring-blue-300';
            container.appendChild(newInput);
        });
    </script>
</body>
</html>
