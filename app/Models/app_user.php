<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class app_user extends Model
{
    Use HasRoles, HasFactory;
    
    protected $table = "app_users";

    protected $fillable = ["email", "password", "role"];
}
