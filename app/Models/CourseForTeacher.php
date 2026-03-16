<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseForTeacher extends Model
{
    protected $fillable = [
        'course_id',
        'teacher_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(TeacherProfile::class, 'teacher_id');
    }
}