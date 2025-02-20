<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-xl p-8">
    <div class="text-center mb-8">
        <h2 class="text-4xl font-bold text-gray-800">Profile Information</h2>
        <p class="mt-2 text-gray-600 text-lg">Manage your account details and personal information.</p>
    </div>

    <div class="flex flex-col items-center">
        <img 
            src="{{ Auth::user()->image_url ? Storage::url(Auth::user()->image_url) : asset('images/default-avatar.png') }}" 
            alt="Profile Picture" 
            class="w-32 h-32 rounded-full shadow-lg border-4 border-gray-200 mb-4"
        />
        
        <p class="text-2xl font-semibold text-gray-900">{{ Auth::user()->name }}</p>
        <p class="text-lg text-gray-500">{{ Auth::user()->email }}</p>
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('profile.edit', Auth::user()->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Edit Profile</a>
    </div>
</div>
