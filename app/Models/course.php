<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    protected $table = "courses";
    protected $fillable = ["name", "description", "thumbnail_url"];
}
