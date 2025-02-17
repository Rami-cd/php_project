<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function enroll($courseId)
    {
        $user = Auth::user();
        if (!$user->enrolled_courses()->where('course_id', $courseId)->exists()) {
            $user->enrolled_courses()->attach($courseId);
            return redirect()->back()->with('success', 'Enrollment successful!');
        }

        return redirect()->back()->with('success', 'User already enrolled!');
    }
    public function unenroll($courseId)
    {
        $user = Auth::user();

        // Check if the user is enrolled in the course
        if ($user->enrolled_courses()->where('course_id', $courseId)->exists()) {
            // Unenroll the user by detaching the course from the user
            $user->enrolled_courses()->detach($courseId);
            return redirect()->back()->with('success', 'unEnrollment successful!');
        }

        return redirect()->back()->with('success', 'User not enrolled!');
    }
}