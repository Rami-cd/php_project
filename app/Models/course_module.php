<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Course_module extends Model
{
    use HasFactory;
    protected $table = "course_modules";

    protected $fillable = ["name", "description", "pourcentage", "order"];

    // app/Models/CourseModule.php
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
