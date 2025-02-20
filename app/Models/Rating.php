<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_id', 'rating_value'];

    // Define the relationship with items and users
    public function item()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
