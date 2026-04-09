@extends('base')

@section('content')
<div class="my-5 mx-auto" style="max-width: 800px;">
    <h2 class="fw-bold mb-2" style="color: #d4a017;">{{ $test->title }}</h2>
    
    <form action="/lesson/{{ $test->id }}/test" method="POST">
        @csrf
        @foreach($test->questions as $question)
        <div class="bg-light p-4 mb-4 border rounded">
            <h5 class="fw-bold mb-4">{{ $loop->iteration }}. {{ $question->question_text }}</h5>
            
            @foreach($question->answers as $answer)
            <div class="form-check mb-2">
                @if($question->type === 'multiple')
                    <input class="form-check-input" type="checkbox" name="question_{{ $question->id }}[]" value="{{ $answer->id }}" id="ans_{{ $answer->id }}">
                @else
                    <input class="form-check-input" type="radio" name="question_{{ $question->id }}" value="{{ $answer->id }}" id="ans_{{ $answer->id }}">
                @endif
                <label class="form-check-label" for="ans_{{ $answer->id }}" style="cursor: pointer;">
                    {{ $answer->answer_text }}
                </label>
            </div>
            @endforeach
            
        </div>
        @endforeach
        
        <button type="submit" class="btn w-100 py-3 mt-3 fw-bold fs-5 " style="background-color: #d4a017; color: white;">
            Проверить
        </button>

        @if(session('score') !== null)
            @php
                $totalQ = $test->questions->count();
                $percent = session('percent') ?? ($totalQ > 0 ? round((session('score') / $totalQ) * 100) : 0);
            @endphp
            
            <div class="alert alert-success mt-4 fs-5 text-center shadow-sm border-0 bg-success text-white">
                Ваш результат: <strong>{{ $percent }}%</strong> <br>
                <span class="fs-6">(Правильных ответов: {{ session('score') }} из {{ $totalQ }})</span>
            </div>
        @endif

        @if(session('fail'))
            <div class="alert alert-warning mt-3">
                Проходной балл: {{ $test->passing_score }}%. Можно попробовать ещё раз.
            </div>
        @endif

    </form>
</div>
@endsection
