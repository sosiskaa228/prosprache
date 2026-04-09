<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Course;

class EnrollmentController extends BaseTeacherCourseController
{
    public function destroyStudent(Course $course, $studentId)
    {
        $this->authorizeTeacherCourse($course);
        $course->students()->detach($studentId);

        return back()->with('success', 'Студент отчислен');
    }

    public function approve(Course $course, $studentId)
    {
        $this->authorizeTeacherCourse($course);
        $course->students()->updateExistingPivot($studentId, ['status' => 'approved']);

        return back()->with('success', 'Заявка одобрена');
    }

    public function reject(Course $course, $studentId)
    {
        $this->authorizeTeacherCourse($course);
        $course->students()->detach($studentId);

        return back()->with('success', 'Заявка отклонена');
    }
}

