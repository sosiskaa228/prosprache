<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Test;
use App\Models\TestResult; 

class LessonController extends Controller {
    
    public function show($id) {
        $lesson = Lesson::find($id); 
        return view('lesson', ['lesson' => $lesson]);
    }

    public function showTest($id) {
        $test = Test::with('questions.answers')->find($id); 
        return view('test', ['test' => $test]);
    }

    public function toggleComplete($id)
    {
        $user = auth()->user();
        
        $user->completedLessons()->toggle($id);

        return back();
    }

    public function submitTest(Request $request, $id)
    {
        $score = 0; 
        $questions = \App\Models\Question::where('test_id', $id)->get();
        foreach ($questions as $question) {
            
            $answerId = $request->input('question_' . $question->id);
            
            if ($answerId != null) {
                
                $answer = \App\Models\Answer::find($answerId);
                
                if ($answer->is_correct == 1) {
                    $score = $score + 1; 
                }
            }
        }
        
        $result = new \App\Models\TestResult();
        $result->user_id = auth()->user()->id; 
        $result->test_id = $id;                
        $result->score = $score;               
        $result->save();                     
        return back()->with('score', $score);
    }
}
