<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,  // Fake course name
            'description' => $this->faker->paragraph,  // Fake course description
            'thumbnail_url' => $this->faker->imageUrl(),  // Fake image URL for thumbnail
        ];
    }
}
