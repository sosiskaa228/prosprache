<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'level',
        'is_published',
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(TeacherProfile::class, 'course_for_teachers', 'course_id', 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'course_tag');
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}