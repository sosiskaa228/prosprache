@extends('base')

@section('content')
<h2 class="mb-4 px-2">Наши курсы</h2>
<div class="row gy-4">

    @foreach($courses as $course)
    <div class="col-md-4">
        <div class="p-4 bg-light">
            <h4 class="fw-bold">{{ $course->title }}</h4>
            <p class="text-muted mb-2">Уровень: {{ $course->level }}</p>
            <p>{{ $course->description }}</p>
            <a href="/courses/{{ $course->id }}" class="text-decoration-none" style="color: #d4a017; font-weight: bold;">Подробнее</a>
        </div>
    </div>
    @endforeach

</div>
@endsection
