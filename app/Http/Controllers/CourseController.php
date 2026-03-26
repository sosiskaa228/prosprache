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
        return back()->with('success', 'Ваша заявка принята на рассмотрение! Как только преподаватель её одобрит, уроки откроются.');
    }

}
