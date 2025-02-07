<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\Artisan;

class GateTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();

        // Seed the data before each test
        Artisan::call('db:seed', ['--class' => 'RoleAndPermissionSeeder']);
    }
    /**
     * A basic feature test example.
     */

    #[Test]
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    #[Test]
    public function user_can_create_course_if_creator()
    {
        // Create a user and a course
        $user = User::factory()->create();
        $course = Course::factory()->create();

        // Attach user to course as a creator
        $course->users()->attach($user->id);

        // Check if the user is allowed by the gate
        $this->assertTrue(Gate::forUser($user)->allows('edit-course', $course));
    }

    #[Test]
    public function user_cannot_create_course_if_not_creator()
    {
        // Create a user and a course
        $user = User::factory()->create();
        $course = Course::factory()->create();

        // Ensure the user is not attached
        $this->assertFalse(Gate::forUser($user)->allows('edit-course', $course));
    }
}
