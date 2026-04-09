@extends('base')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Редактировать курс</h2>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('teacher.courses.update', ['course' => $course->id]) }}" class="card mb-4">
        @csrf
        @method('PUT')
        <div class="card-body">
            <h5 class="mb-3">Информация о курсе</h5>

            <div class="mb-3">
                <label class="form-label">Название</label>
                <input name="title" class="form-control" value="{{ old('title', $course->title) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea name="description" class="form-control" rows="5">{{ old('description', $course->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Уровень</label>
                <input name="level" class="form-control" value="{{ old('level', $course->level) }}">
            </div>

            <button class="btn btn-primary">Сохранить</button>
        </div>
    </form>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="mb-3">Уроки</h5>

                    <form method="POST" action="{{ route('teacher.courses.lessons.store', ['course' => $course->id]) }}" class="mb-3">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label">Название урока</label>
                            <input name="lesson_title" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Ссылка на материал</label>
                            <input name="lesson_file_path" class="form-control">
                        </div>
                        <button class="btn btn-sm btn-success">Добавить урок</button>
                    </form>

                    @if($course->lessons->isEmpty())
                        <div class="text-muted">Уроков пока нет.</div>
                    @else
                        <ul class="list-group">
                            @foreach($course->lessons->sortBy('created_at') as $lesson)
                                <li class="list-group-item">
                                    <div class="fw-bold mb-2">Урок: {{ $lesson->title }}</div>

                                    <form method="POST" action="{{ route('teacher.courses.lessons.update', ['course' => $course->id, 'lesson' => $lesson->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-6">
                                                <label class="form-label">Название</label>
                                                <input name="title" class="form-control" value="{{ $lesson->title }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Ссылка на материал</label>
                                                <input name="file_path" class="form-control" value="{{ $lesson->file_path }}">
                                            </div>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary mt-2">Сохранить урок</button>
                                    </form>

                                    <form method="POST" action="{{ route('teacher.courses.lessons.destroy', ['course' => $course->id, 'lesson' => $lesson->id]) }}" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Удалить урок?')">Удалить</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="mb-3">Заявки и студенты</h5>

                    @php
                        $pending = $course->students->filter(fn($s) => ($s->pivot->status ?? 'approved') === 'pending');
                        $approved = $course->students->filter(fn($s) => ($s->pivot->status ?? 'approved') === 'approved');
                    @endphp

                    <div class="mb-3">
                        <div class="fw-bold mb-2">Заявки (ожидают)</div>
                        @if($pending->isEmpty())
                            <div class="text-muted">Заявок нет.</div>
                        @else
                            <ul class="list-group">
                                @foreach($pending as $student)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="fw-bold">{{ $student->name }}</div>
                                            <div class="text-muted small">{{ $student->email }}</div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <form method="POST" action="{{ route('teacher.courses.requests.approve', ['course' => $course->id, 'studentId' => $student->id]) }}">
                                                @csrf
                                                <button class="btn btn-sm btn-success">Принять</button>
                                            </form>
                                            <form method="POST" action="{{ route('teacher.courses.requests.reject', ['course' => $course->id, 'studentId' => $student->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Отклонить заявку?')">Отклонить</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div>
                        <div class="fw-bold mb-2">Студенты (доступ открыт)</div>
                        @if($approved->isEmpty())
                            <div class="text-muted">Пока нет студентов.</div>
                        @else
                            <ul class="list-group">
                                @foreach($approved as $student)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="fw-bold">{{ $student->name }}</div>
                                            <div class="text-muted small">{{ $student->email }}</div>
                                        </div>
                                        <form method="POST" action="{{ route('teacher.courses.students.destroy', ['course' => $course->id, 'studentId' => $student->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Отчислить студента?')">Отчислить</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-3">Тесты</h5>

            <form method="POST" action="{{ route('teacher.courses.tests.store', ['course' => $course->id]) }}" class="mb-4">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-md-8">
                        <label class="form-label">Название теста</label>
                        <input name="test_title" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Проходной балл (%)</label>
                        <input name="test_passing_score" type="number" min="0" class="form-control" value="1" required>
                    </div>
                </div>
                <button class="btn btn-warning mt-3">Создать тест</button>
            </form>

            @if($course->tests->isEmpty())
                <div class="text-muted">Тестов пока нет.</div>
            @else
                @foreach($course->tests as $test)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2 gap-2 flex-wrap">
                                <div class="fw-bold">
                                    {{ $test->title }}
                                    <span class="text-muted">(проходной: {{ $test->passing_score }})</span>
                                </div>

                                <form method="POST" action="{{ route('teacher.courses.tests.destroy', ['course' => $course->id, 'test' => $test->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Удалить тест?')">Удалить тест</button>
                                </form>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="fw-bold mb-2">Добавить вопрос</div>

                                    <form method="POST" action="{{ route('teacher.courses.tests.questions.store', ['course' => $course->id, 'test' => $test->id]) }}">
                                        @csrf
                                        <div class="mb-2">
                                            <label class="form-label">Текст вопроса</label>
                                            <textarea name="question_text" class="form-control" rows="2" required></textarea>
                                        </div>

                                        <div class="row g-2">
                                            @for ($i = 0; $i < 4; $i++)
                                                <div class="col-md-6">
                                                    <label class="form-label">
                                                        Вариант {{ $i + 1 }}
                                                        @if($i >= 2)
                                                            <span class="text-muted">(необязательно)</span>
                                                        @endif
                                                    </label>
                                                    <input class="form-control" name="answers[]" @if($i < 2) required @endif>
                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox" name="correct[]" value="{{ $i }}" id="c_{{ $test->id }}_{{ $i }}">
                                                        <label class="form-check-label" for="c_{{ $test->id }}_{{ $i }}">Правильный</label>
                                                    </div>
                                                </div>
                                            @endfor
                                        </div>

                                        <button class="btn btn-sm btn-success mt-3">Добавить вопрос</button>
                                    </form>
                                </div>
                            </div>

                            @if($test->questions->isEmpty())
                                <div class="text-muted">Вопросов пока нет.</div>
                            @else
                                @foreach($test->questions as $q)
                                    <div class="mb-3 border rounded p-3">
                                        <form method="POST" action="{{ route('teacher.courses.tests.questions.update', ['course' => $course->id, 'test' => $test->id, 'question' => $q->id]) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-2">
                                                <label class="form-label">Текст вопроса</label>
                                                <textarea name="question_text" class="form-control" rows="2" required>{{ $q->question_text }}</textarea>
                                            </div>

                                            <div class="row g-2">
                                                @foreach($q->answers as $idx => $a)
                                                    <div class="col-md-6">
                                                        <label class="form-label">Вариант {{ $idx + 1 }}</label>
                                                        <input type="hidden" name="answers[{{ $idx }}][id]" value="{{ $a->id }}">
                                                        <input class="form-control" name="answers[{{ $idx }}][text]" value="{{ $a->answer_text }}" required>
                                                        <div class="form-check mt-1">
                                                            <input class="form-check-input" type="checkbox" name="correct[]" value="{{ $idx }}" id="edit_{{ $q->id }}_{{ $a->id }}" @checked($a->is_correct)>
                                                            <label class="form-check-label" for="edit_{{ $q->id }}_{{ $a->id }}">Правильный</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="d-flex gap-2 mt-3 flex-wrap">
                                                <button class="btn btn-sm btn-outline-primary">Сохранить вопрос</button>
                                            </div>
                                        </form>

                                        <form method="POST" action="{{ route('teacher.courses.tests.questions.destroy', ['course' => $course->id, 'test' => $test->id, 'question' => $q->id]) }}" class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Удалить вопрос?')">Удалить вопрос</button>
                                        </form>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <form method="POST" action="{{ route('teacher.courses.destroy', ['course' => $course->id]) }}" class="mt-4">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" onclick="return confirm('Точно удалить курс? Это действие нельзя отменить.')">
            Удалить курс
        </button>
    </form>
</div>
@endsection