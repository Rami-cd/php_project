<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseModuleController;
use App\Http\Controllers\EnrollmentController;
use App\Models\Categories;
use App\Models\course;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;

Route::get('/', function () {
    // $courses = Course::all();  // Retrieve all courses
    // return view('Courses.index', compact('courses'));
    // return view('testview');
    // return view('courses.createcourse');

    $courses = Course::has('modules')->paginate(8);
    $categories = Categories::all();
    return view('home', compact('categories', 'courses'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test-form', function () {
    return view('testform');
});

Route::post('/submit-form', function (Request $request) {
    $course = Course::find($request->input('course'));
    if (Gate::allows('create-course', [$course])) { 
        return response()->json(["message" => "success"], 200);
    } else {
        return response()->json(["message" => "failed"], 400);
    }
});



// courses routes
// no guard anyone can see the courses
Route::get("/courses", [CourseController::class, 'get_all_courses'])
    ->name('get_all_courses');

Route::get("/courses/{id}", [CourseController::class, 'get_course_by_id'])
    ->name('get_course_by_id');

Route::post('/courses/create-course', [CourseController::class, 'create_course'])
    ->name('create_course')
    ->middleware(['auth', 'permission:create courses']);

Route::put('/courses/{id}', [CourseController::class, 'edit_course'])
    ->name('edit_course')
    ->middleware(['auth', 'permission:manage courses']);

Route::delete('/courses/{id}', [CourseController::class, 'delete_course'])
    ->name('delete_course')
    ->middleware(['auth', 'permission:delete courses']);

Route::get('/courses/info/{id}', [CourseController::class, 'show_course_info'])
    ->name('show_course_info');

Route::post('/courses/create_module', [CourseModuleController::class, 'create_module'])
    ->name('create_module');

Route::get('/courses/module_form/{course}', [CourseModuleController::class, 'module_form'])
    ->name('module_creation_form');

Route::get('/courses/search', [CourseController::class, 'search'])
    ->name('courses.search');

    // Route::get('/courses/{courseId}', [CourseController::class, 'show'])->name('courses.show');
    // Route::get('/courses/{courseId}/module/{moduleId}', [CourseController::class, 'module'])->name('courses.module');
// courses routes


// modules routes
Route::get('/module/{module}/edit', [CourseModuleController::class, 'edit'])->name('module.edit');
Route::put('/module/{module}', [CourseModuleController::class, 'update'])->name('module.update');
// modules routes


// User routes
Route::post('/enroll/{course}', [EnrollmentController::class, 'enroll'])
    ->middleware(['auth', 'permission:manage courses'])
    ->name('courses.enroll');
Route::post('/unenroll/{courseId}', [EnrollmentController::class, 'unenroll'])
    ->middleware(['auth', 'permission:manage courses'])
    ->name('courses.unenroll');
// User routes


// Home Controller
Route::get('/search', [HomeController::class, 'search'])
    ->name('home.search');
// Home Controller


// testing routes
Route::post('/testing_1', function(Request $request) {
    return view('testform2', ['id'=> $request->input('id')]);
})->middleware(['auth', 'permission:manage courses']);
// testing routes


// Admin routes
Route::prefix('admin')->middleware(['role:admin'])->group(function() {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Users management
    Route::get('/users', [AdminController::class, 'listUsers'])->name('admin.users.index');
    // Courses management
    Route::get('/courses', [AdminController::class, 'listCourses'])->name('admin.courses.index');

    Route::get('/users/{user}/permissions', [AdminController::class, 'editPermissions'])->name('admin.users.permissions');

    Route::post('/users/{user}/permissions', [AdminController::class, 'updatePermissions'])->name('admin.users.permissions.update');

    Route::get('/admin/users/{user}/roles', [AdminController::class, 'editRoles'])->name('admin.users.roles');

    Route::post('/admin/users/{user}/roles', [AdminController::class, 'updateRoles'])->name('admin.users.roles.update');

    Route::delete('/courses/{id}/delete', [AdminController::class, 'deleteCourse'])->name('admin.courses.delete');
});
// Admin routes


require __DIR__.'/auth.php';