<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Course;

class CourseCard extends Component
{
    public $course;

    public function __construct($course)
    {
        $this->course = $course;
    }

    public function render()
    {
        return view('components.course-card');
    }
}

