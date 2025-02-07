<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_profile extends Model
{
    protected $table = "user_profiles";
    protected $fillables = ["first_name", "last_name", "headline", 
                            "language", "portfolio_url","linkedin_url",
                            "twitter_url","facebook_url","youtube_url",
                            "image_url"];

    // public function user_id() {
    //     return $this->belongsTo(app_user::class, "app_user");
    // }
}
