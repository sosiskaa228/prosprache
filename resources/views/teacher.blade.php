@extends('base')

@section('content')
<div class="my-4">
    <div class="d-flex align-items-center mb-5 flex-wrap">
        <img src="/images/teachers/{{ $teacher->photo }}" 
             style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%; margin-right: 40px;" 
             alt="{{ $teacher->user->name }}">
             
        <div class="flex-grow-1 mt-3">
            <h1 class="fw-bold" style="color: #d4a017;">{{ $teacher->user->name }}</h1>
            <p class="text-muted mb-3">Опыт преподавания: {{ $teacher->experience }}</p>
            <p class="fs-5" style="line-height: 1.6; max-width: 800px;">{{ $teacher->bio }}</p>
        </div>
    </div>

    <h4 class="mb-4" style="color: #1a1a1a;">Ведёт курсы:</h4>
    <div class="row gy-3">
        @forelse($teacher->courses as $course)
            <div class="col-md-6">
                <div class="p-3 bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">{{ $course->title }}</h5>
                    <div>
                        <span class="text-muted me-3">{{ $course->level }}</span>
                        <a href="/courses/{{ $course->id }}" style="color: #d4a017; font-weight: bold; text-decoration: none;">Перейти</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">Преподаватель пока не ведёт курсы.</p>
            </div>
        @endforelse
    </div>
    
</div>
@endsection
