<?php

namespace Database\Factories;

use App\Models\Creator;
use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreatorFactory extends Factory
{
    protected $model = Creator::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),  // Create a User instance for the foreign key
            'course_id' => Course::factory(), // Create a Course instance for the foreign key
        ];
    }
}
