<?php

namespace App\Models;
use App\Models\Course;
use App\Models\Lesson;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_user');
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Course::class, 'favorites');
    }

    public function completedLessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_user');
    }

}