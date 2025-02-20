<table class="w-full text-sm text-left text-gray-600 border-collapse border border-gray-300">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2 border border-gray-300">Profile</th>
            <th class="px-4 py-2 border border-gray-300">Username</th>
            <th class="px-4 py-2 border border-gray-300">Email</th>
            <th class="px-4 py-2 border border-gray-300">Points</th>
        </tr>
    </thead>
    <tbody>
        @foreach($teachers as $teacher)
            <tr class="border-t border-gray-300 hover:bg-gray-50">
                <td class="px-4 py-2">
                <img src="{{ Storage::url($teacher->image_url) }}"
     onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($teacher->name) }}&background=random&color=fff';"
     alt="Profile Image"
     class="w-10 h-10 rounded-full object-cover border border-gray-300">


                </td>
                <td class="px-4 py-2">{{ $teacher->username }}</td>
                <td class="px-4 py-2">{{ $teacher->email }}</td>
                <td class="px-4 py-2">{{ $teacher->points }} 🏆</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination links -->
<div class="mt-4">
    {{ $teachers->links() }}
</div>
