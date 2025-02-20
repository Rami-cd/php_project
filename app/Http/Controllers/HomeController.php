<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Course;
use App\Models\User;

class HomeController extends Controller
{
    public function search(Request $request)
    {
        // Get search query and category ID from the request
        $searchTerm = $request->input('search_term');
        $categoryId = $request->input('category_id');

        // Fetch categories for the dropdown
        $categories = Categories::all();

        $teachers = User::role('teacher')
            ->orderByDesc('points')
            ->paginate(10);

        // Query courses with optional search term and category filter
        $courses = Course::query()
            ->when($searchTerm, function ($query) use ($searchTerm) {
                return $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->get();

        // Check if the request is an AJAX request
        if ($request->ajax()) {
            // Return the partial view containing the updated courses list
            return view('courses.main', compact('courses'));
        }

        // Return the full view if not an AJAX request
        return view('home', compact('courses', 'categories', 'teachers'));
    }

    public function searchTeacher(Request $request)
{
    $searchTerm = $request->input('search_term');

    \Log::info("Search term received: " . $searchTerm);

    // Query teachers based on search term
    $teachers = User::role('teacher')
        ->where(function ($query) use ($searchTerm) {
            $query->where('username', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%");
        })
        ->orderByDesc('points')
        ->paginate(10);

    // Return JSON response
    return response()->json([
        'teachers' => view('partials.teacher_list', compact('teachers'))->render()
    ]);
}

}
