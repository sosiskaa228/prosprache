<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Test;

class LessonController extends Controller {
    
    public function show($id) {
        $lesson = Lesson::find($id); 
        return view('lesson', ['lesson' => $lesson]);
    }

    public function showTest($id) {
    $test = Test::with('questions.answers')->find($id); 
    return view('test', ['test' => $test]);
    }

}
