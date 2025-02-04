<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class test_controller_1 extends Controller
{
    public function edit() {
        return response()->json(["message", "Hello you have permission to"], 200);
    }
}