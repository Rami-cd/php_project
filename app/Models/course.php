<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Course_module;
use App\Models\Categories;

class Course extends Model
{
    use HasFactory;
    protected $table = "courses";
    protected $fillable = ["name", "description", "thumbnail_url"];

    // connect to the many to many table creator
    public function users()
    {
        return $this->belongsToMany(User::class, 'creators', 'course_id', relatedPivotKey: 'user_id')
                    ->withTimestamps();
    }

    public function user_enrolled_courses()
    {
        return $this->belongsToMany(User::class, 'enrollments');
    }

    // connect to the modules
    public function modules()
    {
        return $this->hasMany(Course_module::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
