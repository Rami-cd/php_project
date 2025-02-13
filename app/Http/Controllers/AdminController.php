<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

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

        // Filter by role using Spatie
        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        // Search logic based on selected search type
        if ($request->filled('search')) {
            if ($request->search_type === 'username') {
                // Search only in the username field
                $query->where('username', 'like', '%' . $request->search . '%');
            } elseif ($request->search_type === 'email') {
                // Search only for Gmail accounts
                $query->where('email', 'like', '%' . $request->search . '%@gmail.com');
            }
        }

        $users = $query->paginate(10);

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

    public function editPermissions(User $user)
    {
        // Get all available permissions
        $permissions = Permission::all();

        // Get user's current permissions
        $userPermissions = $user->permissions->pluck('name')->toArray();

        return view('admin.users.permissions', compact('user', 'permissions', 'userPermissions'));
    }

    public function updatePermissions(Request $request, User $user)
    {
        // Validate input
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        // Sync permissions (revoke all and reassign selected)
        $user->syncPermissions($request->permissions);

        return redirect()->route('admin.users')->with('success', 'Permissions updated successfully.');
    }

    public function editRoles(User $user)
    {
        // Get all available roles
        $roles = Role::all();

        // Get user's current roles
        $userRoles = $user->roles->pluck('name')->toArray();

        return view('admin.users.roles', compact('user', 'roles', 'userRoles'));
    }

    public function updateRoles(Request $request, User $user)
    {
        // Validate input
        $request->validate([
            'roles' => 'array',
            'roles.*' => 'exists:roles,name'
        ]);

        // Sync roles (revoke all and reassign selected)
        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'Roles updated successfully.');
    }

    public function deleteCourse($id) {
        try {
            // Find the course by ID, or fail if not found
            $course = Course::findOrFail(intval($id));
            
            // Check if the user has permission to delete the course
            if (Gate::allows('manage courses', [$course])) { 
                // Proceed to delete the course
                $course->delete();
                
                // Return success message after deletion
                return redirect()->route('admin.courses.index');
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

    public function edit_course_form($id) {
        try {
            $course = Course::findOrFail(intval($id));
            return view('admin.courses.edit', compact('course'));
        } catch (\Exception $e) {
            // Catch any exceptions and return a detailed error response
            throw $e;
        }
    }
}