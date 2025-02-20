<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Categories;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function get_all_courses() {
        try {
            dd("here");
            // Retrieve courses, eager load their ratings, and include rating count and average
            $courses = Course::withCount('ratings')  // Count the number of ratings for each course
                ->with('ratings')  // Eager load ratings
                ->get()
                ->map(function ($course) {
                    // Debugging: Check if ratings are being loaded correctly
                    dd($course->ratings);  // Inspect the loaded ratings for this course
                    
                    // Calculate the average rating for each course (if any ratings exist)
                    if ($course->ratings->isNotEmpty()) {
                        $course->average_rating = $course->ratings->avg('rating');
                    } else {
                        $course->average_rating = 0;  // Default value if no ratings
                    }
    
                    // Debugging: Check if average rating is being calculated
                    dd($course->average_rating);  // Inspect the calculated average
                    
                    return $course;
                });
    
            // Returning courses to view (after ensuring ratings and average are calculated)
            return view('courses.main', compact('courses'));
        } catch (\Exception $e) {
            return response()->json(["error", $e->getMessage()], 400);
        }
    }    
    

    public function get_course_by_id($id)
    {
        // Optionally, find the course here
        $course = Course::find($id);
        
        if (!$course) {
            abort(404); // If course not found, handle error
        } 

        // Redirect to the show_course_info route with the same ID
        return redirect()->route('show_course_info', ['id' => $id]);
    }


    public function create_course(Request $request) {
        try {
            // dd($request->file('thumbnail_url'));

            $filePath = $request->file('thumbnail_url')->store('uploads', 'public');

            $course = Course::create([
                "name"=> $request->name,
                "description"=> $request->description,
                "thumbnail_url"=> $filePath,
                "average_rating"=> 0,
            ]);

            $course->users()->attach(Auth::id());
            $course->users()->attach($request->input('creators'));

            return redirect()->route('module_creation_form', ['course' => $course->id]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function edit_course($id) {
        try {
            // Find the course by ID, or fail if not found
            $course = Course::findOrFail(intval($id));
            
            // Check if the user has permission to edit the course
            if (Gate::allows('manage courses', [$course])) {
                
                // Fetch all modules associated with the course
                $modules = $course->modules; // Assuming Course hasMany CourseModules relationship
    
                return view('courses.editcourse', compact('course', 'modules'));
            } else {
                // Throw an AuthorizationException if the user isn't authorized
                throw new AuthorizationException('You are not authorized to edit this course.');
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return a detailed error response
            throw $e;
        }
    }
    

    public function delete_course($id) {
        try {
            // Find the course by ID, or fail if not found
            $course = Course::findOrFail(intval($id));
    
            // Check if the user has permission to delete the course
            if (Gate::allows('manage courses', [$course])) { 
                // Proceed to delete the course
                $course->delete();
                
                // Return success message after deletion and redirect back to the same page
                return redirect()->back()->with('success', 'Course deleted successfully!');
            } else {
                // Throw an AuthorizationException if the user isn't authorized
                throw new AuthorizationException('You are not authorized to delete this course.');
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return a detailed error response
            return redirect()->back()->with('error', 'An error occurred while deleting the course: ' . $e->getMessage());
        }
    }    

    public function show_course_info($id) {
        $course = Course::findOrFail(intval($id));
        $modules = $course->modules;
        // dd($modules);

        // if (Auth::user()->courses->contains($course)) {
        //     return view('courses.courseinfo', compact('course', 'modules'));
        // }
        return view('courses.courseinfo', compact('course', 'modules'));
    }

    public function add_modules($id) {
        $course = Course::findOrFail(intval($id));
        
    }


    public function course_form() {
        return view('courses.createcourse');
    }

    public function teacherDashboard()
    {
        $teacher = auth()->user();
        
        // Fetch courses where the authenticated teacher is the owner
        $courses = Course::where('teacher_id', $teacher->id)->with('modules')->get();

        return view('teacher.dashboard', compact('courses'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search_term');
        // $categoryId = $request->input('category_id'); // Commented out category filter

        // Query the courses based on the search term
        $courses = Course::when($searchTerm, function ($query) use ($searchTerm) {
                return $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            // Optional category filter logic, you can re-enable it if needed
            // ->when($categoryId, function ($query) use ($categoryId) {
            //     return $query->where('category_id', $categoryId);
            // })
            ->with('ratings') // Eager load the ratings relationship
            ->paginate(10);  // Paginate 10 items per page

        // Calculate the average rating for each course
        foreach ($courses as $course) {
            $course->average_rating = $course->ratings->avg('rating_value'); // Assuming 'rating_value' is the column for rating
        }

        $categories = Categories::all(); // If needed, pass categories to the view

        // Return the view with the paginated courses and categories
        return view('home', compact('courses', 'categories'));
    }

    public function rate(Request $request, $courseId)
{
    // Validate that the rating is an integer between 1 and 5
    $request->validate([
        'rating' => 'required|integer|between:1,5',
    ]);

    $course = Course::findOrFail($courseId);

    // Ensure the user is enrolled in the course
    $user = Auth::user();
    if (!Gate::check('enrolled-in-course', $course)) {
        return back()->withErrors(['error' => 'You must be enrolled in the course to rate it.']);
    }

    // Check if the user has already rated the course
    $existingRating = Rating::where('user_id', $user->id)
                            ->where('course_id', $course->id)
                            ->first();

    // Update or create the rating
    if ($existingRating) {
        // If the user has already rated, update their rating
        $existingRating->update(['rating_value' => $request->rating]);
    } else {
        // If the user hasn't rated, create a new rating
        Rating::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'rating_value' => $request->rating,
        ]);
    }

    // Recalculate the average rating for the course
    $averageRating = $course->ratings()->avg('rating_value');
    $course->average_rating = $averageRating;
    $course->save();  // Save the updated average rating back to the course

    return back()->with('success', 'Your rating has been submitted.');
}

}
