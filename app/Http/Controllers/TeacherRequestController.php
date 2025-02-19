<?php

namespace App\Http\Controllers;

use App\Models\TeacherRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherRequestController extends Controller
{
    public function showForm()
    {
        return view('teacher_request');
    }

    public function submitRequest(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $user = Auth::user();

        // Check if user already has a pending or approved request
        if ($user->teacherRequest || $user->hasRole('teacher')) {
            return redirect()->back()->with('error', 'You already submitted a request or are a teacher.');
        }

        TeacherRequest::create([
            'user_id' => $user->id,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Your request has been submitted and is awaiting approval.');
    }
}
