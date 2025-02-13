<?php

// database/factories/CourseModuleFactory.php

namespace Database\Factories;

use App\Models\Course_module;
use App\Models\Course;  // Import the Course model
use Illuminate\Database\Eloquent\Factories\Factory;

class Course_moduleFactory extends Factory
{
    protected $model = Course_module::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,  // Generates a random word for the module name
            'description' => $this->faker->sentence,  // Generates a random sentence for the description
            'order' => $this->faker->numberBetween(1, 10),  // Generates a random order between 1 and 10
            'course_url' => $this->faker->url,
            'course_id' => Course::factory(),  // Creates a new course using the Course factory
        ];
    }
}