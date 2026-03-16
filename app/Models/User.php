<?php

namespace App\Models;

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
        return $this->belongsToMany(Course::class, 'course_user');
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
}