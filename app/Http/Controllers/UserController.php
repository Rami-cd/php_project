<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function teacherDashboard(Request $request)
    {
        $query = Auth::user()->courses();  // This is a relationship, so we must call paginate()
    
        // Apply search filtering
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        // Paginate the results (10 courses per page)
        $courses = $query->paginate(10); // Now $courses is a Paginator instance
    
        return view('teacher.dashboard', compact('courses'));
    }
    
    // public function getTeachers(Request $request) {
    //     $teachers = User::role('teacher')
    //             ->orderByDesc('points')
    //             ->paginate(10);
    //     return view('partials.teacher_list', compact('$teachers'));
    // }
}
