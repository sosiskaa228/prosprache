<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends BaseTeacherCourseController
{
    public function store(Request $request, Course $course)
    {
        $this->authorizeTeacherCourse($course);

        $data = $request->validate([
            'lesson_title' => ['required', 'string', 'max:255'],
            'lesson_file_path' => ['required', 'string', 'max:255'],
        ]);

        $course->lessons()->create([
            'title' => $data['lesson_title'],
            'file_path' => $data['lesson_file_path'],
        ]);

        return back()->with('success', 'Урок добавлен');
    }

    public function update(Request $request, Course $course, Lesson $lesson)
    {
        $this->authorizeTeacherCourse($course);
        if ((int) $lesson->course_id !== (int) $course->id) {
            abort(404);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'file_path' => ['required', 'string', 'max:255'],
        ]);

        $lesson->update($data);

        return back()->with('success', 'Урок обновлен');
    }

    public function destroy(Course $course, Lesson $lesson)
    {
        $this->authorizeTeacherCourse($course);
        if ((int) $lesson->course_id !== (int) $course->id) {
            abort(404);
        }

        $lesson->delete();

        return back()->with('success', 'Урок удален');
    }
}

