<script src="https://cdn.tailwindcss.com"></script>
<div class="container mx-auto mt-10 p-6 bg-white shadow-xl rounded-lg max-w-lg">
    <h2 class="text-center text-3xl font-semibold text-indigo-600 mb-6">Become a Teacher</h2>

    @if(session('success'))
        <div class="alert alert-success text-center mb-4 px-6 py-3 bg-green-100 text-green-800 border border-green-400 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center mb-4 px-6 py-3 bg-red-100 text-red-800 border border-red-400 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    @php
        $existingRequest = Auth::user()->teacherRequest; // Fetch the user's request
    @endphp

    @if(!$existingRequest)
        <form action="{{ route('become.teacher') }}" method="POST" class="bg-gray-50 p-6 rounded-lg shadow-lg">
            @csrf
            <div class="mb-6">
                <label for="reason" class="block text-lg font-medium text-gray-700 mb-2">Why do you want to become a teacher?</label>
                <textarea name="reason" id="reason" class="form-control w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" rows="5" placeholder="Share your reason..." required></textarea>
            </div>
            <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition duration-300">Submit Request</button>
        </form>
    @else
        <div class="alert alert-info text-center mt-6 p-4 bg-yellow-100 text-yellow-800 border border-yellow-400 rounded-lg">
            You have already submitted a request. Status:  
            <strong class="text-indigo-600">{{ ucfirst($existingRequest->status) }}</strong>
        </div>
    @endif
</div>
