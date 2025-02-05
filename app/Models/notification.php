<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $fillables = ["message", "type", "is_read", "delivered_at"];
}
