<script src="https://cdn.tailwindcss.com"></script>
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Teacher Requests</h2>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-400 p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Alert -->
    @if(session('error'))
        <div class="bg-red-100 text-red-800 border border-red-400 p-4 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Requests Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">User</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Reason</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Status</th>
                    <th class="px-4 py-2 text-center text-sm font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($requests as $request)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm">{{ $request->user->name }}</td>
                        <td class="px-4 py-2 text-sm">{{ $request->reason }}</td>
                        <td class="px-4 py-2 text-sm">
                            @if($request->status === 'pending')
                                <div class="flex justify-center gap-4">
                                    <form action="{{ route('admin.approve.teacher', $request->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none transition duration-200">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.reject.teacher', $request->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none transition duration-200">Reject</button>
                                    </form>
                                </div>
                            @elseif($request->status === 'approved')
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Approved</span>
                            @else
                                <span class="inline-block px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Rejected</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
