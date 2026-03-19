@extends('base')

@section('content')
<div class="my-4">
    <div class="p-5 bg-light">
        <h1 class="fw-bold" style="color: #d4a017;">{{ $course->title }}</h1>
        <p class="text-muted mb-4">Уровень: {{ $course->level }}</p>
        
        <div class="mb-5">
            <p class="fs-5" style="line-height: 1.6;">{{ $course->description }}</p>
        </div>
        
        <a href="#" class="btn px-5 py-2 rounded-0 border-0" style="background-color: #d4a017; color: #1a1a1a; font-weight: bold;">Записаться</a>
    </div>
</div>
@endsection
