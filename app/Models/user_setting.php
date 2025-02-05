<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_setting extends Model
{
    protected $fillables = ["course_recs", "offers_promotions","email_notification",
                            "instructor_notification"];
}
