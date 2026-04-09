<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Answer;
use App\Models\Course;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends BaseTeacherCourseController
{
    public function store(Request $request, Course $course)
    {
        $this->authorizeTeacherCourse($course);

        $data = $request->validate([
            'test_title' => ['required', 'string', 'max:255'],
            'test_passing_score' => ['required', 'integer', 'min:0'],
        ]);

        Test::create([
            'course_id' => $course->id,
            'title' => $data['test_title'],
            'passing_score' => $data['test_passing_score'],
        ]);

        return back()->with('success', 'Тест создан');
    }

    public function destroy(Course $course, Test $test)
    {
        $this->authorizeTeacherCourse($course);
        if ((int) $test->course_id !== (int) $course->id) {
            abort(404);
        }

        $test->delete();

        return back()->with('success', 'Тест удалён');
    }

    public function storeQuestion(Request $request, Course $course, Test $test)
    {
        $this->authorizeTeacherCourse($course);
        if ((int) $test->course_id !== (int) $course->id) {
            abort(404);
        }

        $data = $request->validate([
            'question_text' => ['required', 'string'],
            'answers' => ['required', 'array', 'min:2'],
            'correct' => ['nullable', 'array'],
            'correct.*' => ['integer'],
        ]);

        $answers = array_values(array_filter(
            array_map(fn ($v) => is_string($v) ? trim($v) : '', $data['answers']),
            fn ($v) => $v !== ''
        ));

        if (count($answers) < 2) {
            return back()->withErrors(['answers' => 'Нужно минимум 2 варианта ответа.']);
        }

        $correct = array_map('intval', $data['correct'] ?? []);
        $type = count($correct) > 1 ? 'multiple' : 'single';

        $question = Question::create([
            'test_id' => $test->id,
            'question_text' => $data['question_text'],
            'type' => $type,
        ]);

        foreach ($answers as $idx => $text) {
            Answer::create([
                'question_id' => $question->id,
                'answer_text' => $text,
                'is_correct' => in_array($idx, $correct, true),
            ]);
        }

        return back()->with('success', 'Вопрос добавлен');
    }

    public function updateQuestion(Request $request, Course $course, Test $test, Question $question)
    {
        $this->authorizeTeacherCourse($course);
        if ((int) $test->course_id !== (int) $course->id || (int) $question->test_id !== (int) $test->id) {
            abort(404);
        }

        $data = $request->validate([
            'question_text' => ['required', 'string'],
            'answers' => ['required', 'array', 'min:2'],
            'answers.*.id' => ['required', 'integer'],
            'answers.*.text' => ['required', 'string', 'max:255'],
            'correct' => ['nullable', 'array'],
            'correct.*' => ['integer'],
        ]);

        $correct = array_map('intval', $data['correct'] ?? []);

        $question->update([
            'question_text' => $data['question_text'],
            'type' => count($correct) > 1 ? 'multiple' : 'single',
        ]);

        foreach ($data['answers'] as $idx => $answerData) {
            $answer = Answer::where('question_id', $question->id)
                ->where('id', $answerData['id'])
                ->first();

            if ($answer) {
                $answer->update([
                    'answer_text' => trim($answerData['text']),
                    'is_correct' => in_array($idx, $correct, true),
                ]);
            }
        }

        return back()->with('success', 'Вопрос обновлён');
    }

    public function destroyQuestion(Course $course, Test $test, Question $question)
    {
        $this->authorizeTeacherCourse($course);
        if ((int) $test->course_id !== (int) $course->id || (int) $question->test_id !== (int) $test->id) {
            abort(404);
        }

        $question->delete();

        return back()->with('success', 'Вопрос удалён');
    }
}