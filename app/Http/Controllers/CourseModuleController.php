<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Course_module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CourseModuleController extends Controller
{
    public function create_module(Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'order' => 'required|integer',
            'module_url' => 'required|file',
        ]);

        // Check for duplicate order
        if (Course_module::where('course_id', $request->course_id)->where('order', $request->order)->exists()) {
            return back()->withInput()->withErrors(['order' => 'A module with this order already exists.']);
        }

        // Store file and create module
        $filePath = $request->file('module_url')->store('uploads', 'public');

        Course_module::create([
            "name" => $request->name,
            "description" => $request->description,
            "order" => $request->order,
            "course_url" => $filePath,
            "course_id" => $request->course_id,
        ]);

        return back()->with("success", "Module created successfully.");
    }

    public function module_form(Course $course) 
    {
        return view('courses.createmodule', compact('course'));
    }

    public function edit($id)
    {
        $module = Course_module::findOrFail($id);
        return view('module.edit', compact('module'));
    }

    public function update(Request $request, $id)
    {
        try {
            $module = Course_module::findOrFail($id);
            $module->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                /*'course_url' => $filePath,*/
            ]);
            if(Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.courses.index', $module->course_id)->with('success', 'Module updated successfully');
            } else {
                return redirect()->route('edit_course', $module->course_id)->with('success', 'Module updated successfully');
            }
        } catch (\Exception $e) {
            // Catch any exceptions and return a detailed error response
            throw $e;
        }
    }
}
