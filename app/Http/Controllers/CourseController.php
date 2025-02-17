<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function get_all_courses() {
        try {
            $courses = Course::query()->orderBy("created_at","desc")->paginate(10);
            return view('courses.main', ["courses"=> $courses]);
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
                
                // Return success message after deletion
                return redirect()->route('get_all_courses');
            } else {
                // Throw an AuthorizationException if the user isn't authorized
                throw new AuthorizationException('You are not authorized to delete this course.');
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return a detailed error response
            return response()->json([
                'message' => 'An error occurred while deleting the course.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    

    public function show_course_info($id) {
        $course = Course::findOrFail(intval($id));
        $modules = $course->modules;
        // dd($modules);

        if (Auth::user()->courses->contains($course)) {
            return view('courses.courseinfo', compact('course', 'modules'));
        }
    }

    public function add_modules($id) {
        $course = Course::findOrFail(intval($id));
        
    }
}
