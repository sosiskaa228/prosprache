<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeacherProfile; 

class TeacherController extends Controller {
    
    public function index() {
        $teachers = TeacherProfile::with('user')->get();
        
        return view('teachers', ['teachers' => $teachers]);

    }

      public function show($id) {
        $teacher = TeacherProfile::with(['user', 'courses'])->find($id);
        
        return view('teacher', ['teacher' => $teacher]);
    }
    public function students(\App\Models\Course $course)
{
    $this->authorizeTeacherCourse($course);

    $students = $course->students()->get();

    return view('teacher.courses.students', compact('course', 'students'));
}

public function removeStudent(\App\Models\Course $course, $studentId)
{
    $this->authorizeTeacherCourse($course);

    $course->students()->detach($studentId);

    return back()->with('success', 'Студент отчислен');
}

private function authorizeTeacherCourse(\App\Models\Course $course)
{
    $user = auth()->user();

    if (!$user || $user->role !== 'teacher') {
        abort(403);
    }

    $teacherProfile = \App\Models\TeacherProfile::where('user_id', $user->id)->first();
    if (!$teacherProfile || !$teacherProfile->courses()->whereKey($course->id)->exists()) {
        abort(403);
    }
}

}
