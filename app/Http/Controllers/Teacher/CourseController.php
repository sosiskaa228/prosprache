<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\TeacherProfile;

class CourseController extends BaseTeacherCourseController
{
    public function create()
    {
        return view('teacher.courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:courses,title'],
            'description' => ['required', 'string'],
        ], [
            'title.required' => 'Введите название курса',
            'title.unique' => 'Курс с таким названием уже существует',
            'title.max' => 'Название курса слишком длинное',
            'description.string' => 'Описание должно быть строкофй',
        ]);

        $course = Course::create($data);
        $user = auth()->user();

        $teacherProfile = TeacherProfile::firstOrCreate(['user_id' => $user->id]);
        $teacherProfile->courses()->attach($course->id);

        return redirect()->route('home')->with('success', 'Курс создан');
    }

    public function edit(Course $course)
    {
        $this->authorizeTeacherCourse($course);
        $course->load(['lessons', 'students', 'tests.questions.answers']);

        return view('teacher.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $this->authorizeTeacherCourse($course);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'level' => ['required', 'string', 'max:255'],
        ]);

        $course->update($data);

        return redirect()->route('home')->with('success', 'Курс обновлен');
    }

    public function destroy(Course $course)
    {
        $this->authorizeTeacherCourse($course);
        $course->delete();

        return redirect()->route('home')->with('success', 'Курс удален');
    }

}

