@extends('base')

@section('content')
<div class="my-5">
    <div class="bg-light p-5 mx-auto border" style="max-width: 800px;">
        
        <h2 class="fw-bold mb-4" style="color: #d4a017;">Урок {{ $lesson->id }}. {{ $lesson->title }}</h2>
        @if($lesson->file_path)
            <div class="p-4 mb-5 bg-white" style="border-left: 4px solid #1a1a1a;">
                <h5 class="fw-bold mb-3">Материал урока</h5>
                <a href="{{ asset($lesson->file_path) }}" target="_blank" class="text-decoration-none fw-bold" style="color: #1a1a1a; text-decoration: underline !important;">
                    Открыть материал
                </a>
            </div>
        @else
            <div class="alert alert-secondary mb-5">
                Материал для этого урока пока не добавлен.
            </div>
        @endif
        
        <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 pt-4" style="border-top: 1px solid #ddd;">
            @auth
                <form action="/lessons/{{ $lesson->id }}/toggle-complete" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-success px-4 py-2 fw-bold mb-2">
                        Отметить урок как пройденный
                    </button>
                </form>
            @endauth
            
            @php
                $test = $lesson->course?->tests?->first(fn($t) => $t->questions->count() > 0);
            @endphp
            @if($test)
                <a href="/lesson/{{ $test->id }}/test" class="btn px-5 py-2 fw-bold mb-2" style="background-color: #d4a017; color: #1a1a1a;">
                    Пройти тест
                </a>
            @else
                <span class="text-muted fw-bold mb-2">Теста пока нет</span>
            @endif
        </div>
    </div>
</div>
@endsection
