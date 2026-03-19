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


}
