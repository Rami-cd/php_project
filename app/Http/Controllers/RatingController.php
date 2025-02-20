<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    // Store a new rating
    public function store(Request $request, $itemId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
        ]);

        // Save the rating for the current item
        Rating::create([
            'user_id' => auth()->id(),
            'course_id' => $itemId,
            'rating_value' => $request->rating,
        ]);

        return back(); // Redirect back after submitting the rating
    }

    // Display average rating for an item
    public function show($itemId)
    {
        $item = Course::with('ratings')->findOrFail($itemId);
        $averageRating = $item->ratings->avg('rating_value'); // Calculate average rating

        return view('item.show', compact('item', 'averageRating'));
    }
}
