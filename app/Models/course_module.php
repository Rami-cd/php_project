<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class course_module extends Model
{
    protected $table = "";

    protected $fillable = ["name", "description", "pourcentage", "order"];
}
