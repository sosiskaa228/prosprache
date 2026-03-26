@extends('base')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 fw-bold">Личный кабинет</h2>

    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">Мои курсы</h4>

            @if($user->courses->isEmpty())
                <div class="p-5 bg-light rounded text-center border">
                    <h5 class="text-muted">Вы пока не оставили заявок ни на один курс.</h5>
                    <a href="/courses" class="btn btn-primary mt-3">Перейти в каталог</a>
                </div>
            @else
                @foreach($user->courses as $course)
                    <div class="card mb-4 border-0">
                        <div class="card-body p-4 bg-light rounded">
                            <h4 class="card-title fw-bold" style="color: #d4a017;">{{ $course->title }}</h4>
                            <p class="card-text text-muted mb-4">{{ $course->description }}</p>

                            @php
                                $totalLessons = $course->lessons->count();
                                $completedCourseLessons = $user->completedLessons->where('course_id', $course->id)->count();
                                $percent = $totalLessons > 0 ? round(($completedCourseLessons / $totalLessons) * 100) : 0;
                            @endphp

                            <p class="mb-2 fw-bold">Мой прогресс: {{ $completedCourseLessons }} из {{ $totalLessons }} уроков</p>
                            <div class="progress mb-4 border" style="height: 25px; border-radius: 8px;">
                                <div class="progress-bar bg-success fw-bold fs-6" role="progressbar" style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ $percent }}%
                                </div>
                            </div>

                            <a href="/courses/{{ $course->id }}" class="btn fw-bold px-4 py-2" style="background-color: #333; color: white;">
                                Продолжить обучение
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="col-md-4">
            <h4 class="mb-3">Избранное</h4>
            <p>У вас нет курсов в избранном.</p>
        </div>

    </div>
</div>
@endsection
