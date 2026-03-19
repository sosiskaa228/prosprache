@extends('base')

@section('content')
<div class="my-5 mx-auto" style="max-width: 800px;">
    <h2 class="fw-bold mb-2" style="color: #d4a017;">{{ $test->title }}</h2>
    <p class="text-muted mb-5">Пройдите тест, чтобы получить оценку за этот модуль.</p>
    
    <form action="#" method="POST">
        @csrf
        @foreach($test->questions as $question)
        <div class="bg-light p-4 mb-4 border">
            <h5 class="fw-bold mb-4">{{ $loop->iteration }}. {{ $question->question_text }}</h5>
            
            @foreach($question->answers as $answer)
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="question_{{ $question->id }}" value="{{ $answer->id }}" id="ans_{{ $answer->id }}">
                <label class="form-check-label" for="ans_{{ $answer->id }}">
                    {{ $answer->answer_text }}
                </label>
            </div>
            @endforeach
            
        </div>
        @endforeach
        
        <button type="submit" class="btn w-100 py-3 mt-3 fw-bold fs-5" style="background-color: #d4a017; color: #1a1a1a;">
            Завершить тест и показать оценку
        </button>
    </form>
</div>
@endsection
