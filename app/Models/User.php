<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Course;

class User extends Authenticatable /*implements MustVerifyEmail*/
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name', 'headline',
        'language', 'portfolio_url', 'linkedin_url', 'twitter_url', 'facebook_url',
        'youtube_url', 'image_url', 'course_recs', 'offers_promotions', 'email_notification',
        'instructor_notification',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'creators', 'user_id', 'course_id')
                    ->withTimestamps();
    }

    public function enrolled_courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function teacherRequest()
    {
        return $this->hasOne(TeacherRequest::class);
    }

    // on creation of user, it get the student role by default
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->assignRole('student');
        });
    }
}
