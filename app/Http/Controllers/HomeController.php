<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Course;

class HomeController extends Controller
{
    public function search(Request $request)
    {
        // Get search query and category ID from the request
        $searchTerm = $request->input('search_term');
        $categoryId = $request->input('category_id');

        // Fetch categories for the dropdown
        $categories = Categories::all();

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
        return view('home', compact('courses', 'categories'));
    }
}
