<div class="container mx-auto p-6">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-center">Points</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($teachers as $teacher)
                    <tr class="border-b hover:bg-gray-100 transition">
                        <td class="py-4 px-6">{{ $teacher->name }}</td>
                        <td class="py-4 px-6">{{ $teacher->email }}</td>
                        <td class="py-4 px-6 text-center font-semibold text-blue-600">{{ $teacher->points }} 🏆</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination links -->
    <div class="mt-4">
        {{ $teachers->links('vendor.pagination.tailwind') }}
    </div>
</div>
