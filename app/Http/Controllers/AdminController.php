<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin Dashboard
    public function index()
    {
        return view('admin.dashboard');
    }

    // List Users with search and filter
    public function listUsers(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        // Search by name or email
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->paginate(10);  // Pagination
        return view('admin.users.index', compact('users'));
    }

    // List Courses with search and filter
    public function listCourses(Request $request)
    {
        $query = Course::query();

        // Filter by course status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Search by course title
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $courses = $query->paginate(10);  // Pagination
        return view('admin.courses.index', compact('courses'));
    }
}