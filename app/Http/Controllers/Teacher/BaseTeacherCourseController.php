<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\TeacherProfile;

class BaseTeacherCourseController extends Controller
{
    protected function authorizeTeacherCourse(Course $course): void
    {
        $user = auth()->user();
        if (!$user || $user->role !== 'teacher') {
            abort(403);
        }

        $teacherProfile = TeacherProfile::where('user_id', $user->id)->first();
        if (!$teacherProfile || !$teacherProfile->courses()->whereKey($course->id)->exists()) {
            abort(403);
        }
    }
}

