<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

class CourseController extends Controller
{
    public function get_all_courses() {
        try {
            $courses = Course::query()->orderBy("created_at","desc")->paginate(10);
            return response()->json($courses);
        } catch (\Exception $e) {
            return response()->json(["error", $e->getMessage()], 400);
        }
    }

    public function get_course_by_id($id) {
        try {
            $courses = Course::query()->find($id);
            return response()->json($courses);
        } catch (\Exception $e) {
            return response()->json(["error", $e->getMessage()], 400);
        }
    }

    public function create_course(Request $request) {
        return response()->json(["message", "creating a course"], 200);
    }

    public function edit_course($id) {
        try {
            // dd($id);
            $course = Course::findOrFail(intval($id));
            if (Gate::allows('edit-course', [$course])) { 
                return response()->json(["message", "editing this course"], 200);
            } else {
                throw new AuthorizationException('You are not a creator of this course.');
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete_course($id) {
        try {
            // dd($id);
            $course = Course::findOrFail(intval($id));
            if (Gate::allows('edit-course', [$course])) { 
                return response()->json(["message", "deleting this course"], 200);
            } else {
                throw new AuthorizationException('You are not a creator of this course.');
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function show_course_info($id) {
        $course = Course::findOrFail(intval($id));
        $modules = $course->load('modules');
        return view('courses.courseinfo', compact('course', 'modules'));
    }
}
