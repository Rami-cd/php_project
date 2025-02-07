<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;

class test_controller_1 extends Controller
{
    public function edit() {
        return response()->json(["message", "Hello you have permission to"], 200);
    }

    public function create(Request $request) {
        $user = User::find($request->input('user'));
        $course = Course::find($request->input('course'));
        // $response = Gate::inspect('create', [$user, $course]);
        Gate::authorize('create', $course);
    
        dd("we can");
    }

    public function test($id) {
        $course = Course::find($id);
        return response()->json(["message", $course],200);
    }

    public function show() {
        return view('test_1');
    }
}