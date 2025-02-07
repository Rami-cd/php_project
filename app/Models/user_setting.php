<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_setting extends Model
{
    protected $table = "user_settings";
    protected $fillables = ["course_recs", "offers_promotions","email_notification",
                            "instructor_notification"];
}
