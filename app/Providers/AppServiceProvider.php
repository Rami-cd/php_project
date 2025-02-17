<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Course;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('edit-course', function (User $user, Course $course) {
            // You can use the $course argument here along with the $user
            // Example: You can check if the user has permission related to the course
            // dd($user->id, $course->id);  // You can debug and see the values
            return $course->users()->where('user_id', $user->id)->exists();
        });

        Gate::define('enrolled-in-course', function (User $user, Course $course) {
            return $user->enrolled_courses->contains($course);
        });

        Gate::define('is-teacher', function (User $user) {
            return $user->hasRole('teacher');
        });
    }
}
