<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Test;
use App\Models\TestResult; 

class LessonController extends Controller {
    
    public function show($id) {
        $lesson = Lesson::with('course.tests')->find($id);
        return view('lesson', ['lesson' => $lesson]);
    }

    public function showTest($id) {
        $test = Test::with('questions.answers')->findOrFail($id);

        $user = auth()->user();
        if ($user) {
            $existing = \App\Models\TestResult::where('user_id', $user->id)->where('test_id', $test->id)->first();
            $totalQ = $test->questions->count();
            $percent = $totalQ > 0 ? round(($existing?->score ?? 0) / $totalQ * 100) : 0;

            if ($existing && $percent >= $test->passing_score) {
                return redirect()->route('courses.show', ['id' => $test->course_id])
                    ->with('success', 'Повторное прохождение недоступно');
            }
        }

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
        $test = Test::with('questions.answers')->findOrFail($id);

        $existing = \App\Models\TestResult::where('user_id', auth()->user()->id)->where('test_id', $test->id)->first();
        $totalQ = $test->questions->count();
        $existingPercent = $totalQ > 0 ? round(($existing?->score ?? 0) / $totalQ * 100) : 0;

        if ($existing && $existingPercent >= $test->passing_score) {
            return redirect()->route('courses.show', ['id' => $test->course_id])
                ->with('success', 'Тест уже пройден. Повторное прохождение недоступно.');
        }

        $score = 0;
        $questions = $test->questions;

        foreach ($questions as $question) {
            $selected = $request->input('question_' . $question->id);
            if (is_array($selected)) {
                $selectedIds = $selected;
            } elseif ($selected) {
                $selectedIds = [$selected];
            } else {
                $selectedIds = [];
            }

            $selectedIds = array_values(array_unique(array_map('intval', $selectedIds)));

            $correctIds = [];
            foreach ($question->answers as $answer) {
                if ($answer->is_correct === 1) {
                    $correctIds[] = $answer->id;
                }
            }

            sort($selectedIds);
            sort($correctIds);

            if ($selectedIds === $correctIds && count($correctIds) > 0) {
                $score++;
            }
        }
        
        $result = new \App\Models\TestResult();
        $result->user_id = auth()->user()->id;
        $result->test_id = $test->id;
        $result->score = $score;

        if ($existing) {
            $existing->score = $score;
            $existing->save();
        } else {
            $result->save();
        }

        $percent = $totalQ > 0 ? round(($score / $totalQ) * 100) : 0;

        if ($percent >= $test->passing_score) {
            return redirect()->route('courses.show', ['id' => $test->course_id])
                ->with('success', 'Тест пройден!');
        }

        return back()
            ->with('score', $score)
            ->with('percent', $percent)
            ->with('fail', true);
    }

}
