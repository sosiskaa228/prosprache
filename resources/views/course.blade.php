@extends('base')

@section('content')
<div class="container my-5" style="max-width: 900px;">
    
    @if(session('success'))
        <div class="alert alert-success border-0 text-center fw-bold fs-5 mt-3 mb-4 rounded-3">
            {{ session('success') }}
        </div>
    @endif

<div class="card-body p-5 text-center" style="background-color: #fafafa; border-radius: 12px;">
    <h1 class="fw-bold mb-3" style="color: #d4a017;">{{ $course->title }}</h1>
    <p class="lead text-muted">{{ $course->description }}</p>
    
    <span class="badge px-3 py-2 fs-6" style="background-color: #333;">Уровень: {{ $course->level }}</span>

    <div class="mt-4">
        @auth
            @if(auth()->user()->role !== 'teacher')
                @livewire('favorite-button', ['course' => $course])
            @endif
        @endauth
    </div>
</div>



    <div class="row">
        <div class="col-md-12">
            
            @if(auth()->check() && auth()->user()->role === 'teacher')
                <div class="alert alert-info mt-3">
                    Управление курсом доступно в кабинете преподавателя.
                    <a href="{{ route('teacher.courses.edit', ['course' => $course->id]) }}" class="fw-bold">Перейти к редактированию</a>
                </div>
            @elseif(auth()->check() && auth()->user()->courses()->where('course_id', $course->id)->wherePivot('status', 'approved')->exists())
                
                <h3 class="mb-4 style="color: #333;>Материалы курса (Уроки)</h3>
                
                <ul class="list-group mb-5 rounded-3">
                    @foreach($course->lessons as $lesson)
                        @php
                            $isCompleted = auth()->user()->completedLessons->contains($lesson->id);
                        @endphp

                        <li class="list-group-item d-flex justify-content-between align-items-center py-4 border-0">
                            <div>
                                <h5 class="mb-2 fw-bold">{{ $loop->iteration }}. {{ $lesson->title }}</h5>
                                
                                @if($lesson->file_path)
                                    <a href="{{ asset($lesson->file_path) }}" target="_blank" class="text-decoration-none fw-bold" style="color: #d4a017;">
                                        Открыть материал
                                    </a>
                                @else
                                    <span class="text-muted small px-2 py-1 bg-light rounded">Файла нет</span>
                                @endif
                            </div>
                            
                            <form action="/lessons/{{ $lesson->id }}/toggle-complete" method="POST" class="m-0">
                                @csrf
                                @if($isCompleted)
                                    <button type="submit" class="btn btn-success btn-sm fw-bold px-3 py-2">Пройдено</button>
                                @else
                                    <button type="submit" class="btn btn-outline-secondary btn-sm px-3 py-2">Отметить как пройденное</button>
                                @endif
                            </form>
                        </li>
                    @endforeach
                </ul>

                @php
                    $availableTests = $course->tests->filter(fn($t) => $t->questions->count() > 0);
                @endphp

                @if($availableTests->count() > 0)
                    <h3 class="mt-5 mb-4  style="color: #333;>Итоговый тест</h3>
                    
                    <ul class="list-group mb-4 rounded-3">
                        @foreach($availableTests as $test)
                            @php
                                $result = auth()->user()->testResults->where('test_id', $test->id)->first();
                                $totalQ = $test->questions->count();
                                $percent = $result && $totalQ > 0 ? round(($result->score / $totalQ) * 100) : 0;
                                $hasPassed = $result && $percent >= $test->passing_score;
                            @endphp

                            <li class="list-group-item d-flex justify-content-between align-items-center py-4 border-0 ">
                                <div>
                                    <h5 class="mb-1 fw-bold">{{ $test->title }}</h5>
                                </div>
                                
                                <div>
                                    @if($hasPassed)
                                        @php
                                            // $percent уже посчитан выше
                                        @endphp
                                        <button class="btn btn-success btn-sm fw-bold px-4 py-2" disabled>
                                            Пройден ({{ $percent }}%)
                                        </button>
                                    @else
                                        <a href="/lesson/{{ $test->id }}/test" class="btn btn-primary btn-sm fw-bold px-4 py-2" style="background-color: #d4a017; border: none;">
                                            Пройти тест
                                        </a>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif

            @else
                
                <div class="alert alert-warning text-center mt-3 p-5 rounded" style="background-color: #fdf5e6;">
                    <h3 class="mb-3 fw-bold" style="color: #ff4800;">Вы еще не записаны на этот курс!</h3>
                    <p class="text-muted mb-4 fs-5">Материалы и тесты скрыты. Оставьте заявку, чтобы получить доступ ко всему обучению.</p>
                    
                    <form action="{{ route('courses.enroll', ['id' => $course->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-lg fw-bold px-5 py-3" style="background-color: #d4a017; border: none; color: #1a1a1a;">
                            Оставить заявку
                        </button>
                    </form>
                </div>
                
            @endif
        </div>
    </div>
</div>
@endsection
