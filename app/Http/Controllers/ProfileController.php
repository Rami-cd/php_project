<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Handle profile image upload
        if ($request->hasFile('image_url')) {
            
            // Validate image
            $request->validate([
                'image_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add any restrictions you need
            ]);

            // Store image and get the path (hash the file name)
            $path = $request->file('image_url')->store('uploads', 'public');
            $user->image_url = $path; // Store the path in the database
        }

        // Update user information
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show()
    {
        // Return the profile view
        return view('profile.show');
    }

    public function rules()
{
    return [
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'headline' => 'nullable|string|max:255',
        'language' => 'nullable|string|max:255',
        'portfolio_url' => 'nullable|url|max:255',
        'linkedin_url' => 'nullable|url|max:255',
        'twitter_url' => 'nullable|url|max:255',
        'facebook_url' => 'nullable|url|max:255',
        'youtube_url' => 'nullable|url|max:255',
        'image_url' => 'nullable|string|max:255', // For the image URL
        'course_recs' => 'nullable|boolean',
        'offers_promotions' => 'nullable|boolean',
        'email_notification' => 'nullable|boolean',
        'instructor_notification' => 'nullable|boolean',
    ];
}

}
