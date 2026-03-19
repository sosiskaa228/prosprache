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

}
