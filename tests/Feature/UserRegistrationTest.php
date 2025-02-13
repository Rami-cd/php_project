<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;  // Use this to roll back the database after each test

    /**
     * Test that a user can register with a null username
     * and the username will be auto-generated from the email.
     *
     * @return void
     */
    public function test_user_registration_with_null_username()
    {
        // Create a user with a null username (simulating the case where the user doesn't provide it)
        $email = 'testuser@example.com';
        $user = User::factory()->create([
            'email' => $email,
            'username' => null, // Set username to null
        ]);

        // Manually trigger the registration logic that would normally run in the controller
        $controller = new \App\Http\Controllers\Auth\RegisteredUserController();
        $request = \Illuminate\Http\Request::create('/register', 'POST', [
            'name' => $user->name,
            'email' => $user->email,
            'username' => $user->username, // This should be null
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $controller->store($request);  // Call the controller method to process registration

        // Reload the user from the database to get the updated username
        $user->refresh();

        // Assert that the username is no longer null and it was assigned correctly
        $this->assertNotNull($user->username);
        $this->assertEquals(explode('@', $user->email)[0], $user->username);  // Check if username is the email prefix
    }
}
