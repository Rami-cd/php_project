<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\Artisan;

class CourseTeacherTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed the data before each test
        Artisan::call('db:seed', ['--class' => 'RoleAndPermissionSeeder']);
    }

    #[Test]
    public function it_allows_user_with_permission_to_edit_course()
    {
        // Create a user and assign the required permission
        $user = User::factory()->create();
        $user->givePermissionTo('manage courses'); // Spatie permission

        // Create a course
        $course = Course::factory()->create();

        // Act as the authenticated user with permission
        $response = $this->actingAs($user)
            ->put("/courses/{$course->id}", [
                'name' => 'Updated Course Name',
                'description' => 'Updated Course Description',
            ]);

        // Assert the success response
        $response->assertStatus(200)
                 ->assertJson(['message' => 'success']);
    }

    #[Test]
    public function it_denies_user_without_permission_to_edit_course()
    {
        // Create a user without permission
        $user = User::factory()->create();

        // Create a course
        $course = Course::factory()->create();

        // Act as the authenticated user without permission
        $response = $this->actingAs($user)
            ->put("/courses/{$course->id}", [
                'name' => 'Updated Course Name',
                'description' => 'Updated Course Description',
            ]);

        // Assert the forbidden response
        $response->assertStatus(403)
                 ->assertJson(['message' => 'Permission denied']);
    }

    #[Test]
    public function it_requires_authenticated_user()
    {
        // Create a course
        $course = Course::factory()->create();

        // Attempt the request without authentication
        $response = $this->put("/courses/{$course->id}", [
            'name' => 'Updated Course Name',
            'description' => 'Updated Course Description',
        ]);

        // Assert the unauthorized response
        $response->assertStatus(401);
    }
}
