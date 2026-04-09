<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course; 

class CourseController extends Controller {
    
    public function index() {
        $courses = Course::all();
        return view('courses', ['courses' => $courses]);
    }

    public function show($id) {
        $course = Course::find($id);
        return view('course', ['course' => $course]);
    }

    public function enroll($id) {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $course = Course::findOrFail($id);

        $existing = $user->courses()->where('course_id', $course->id)->first();
        if ($existing) {
            $status = $existing->pivot->status ?? 'approved';
            if ($status === 'pending') {
                return back()->with('success', 'Заявка уже отправлена и ожидает подтверждения преподавателя.');
            }
        }

        $user->courses()->attach($course->id, ['status' => 'pending']);

        return back()->with('success', 'Заявка отправлена преподавателю. Доступ появится после подтверждения.');
    }

}
