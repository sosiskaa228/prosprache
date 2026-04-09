@extends('base')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Кабинет преподавателя: {{ $user->name }}</h2>
        <a href="{{ route('teacher.courses.create') }}" class="btn btn-success">Создать новый курс</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h4>Мои курсы</h4>
    @if($courses->isEmpty())
        <p class="text-muted">У вас пока нет курсов. Создайте первый курс.</p>
    @else
        @foreach($courses as $course)
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h5 class="card-title mb-0">{{ $course->title }}</h5>
                        <a href="{{ route('teacher.courses.edit', ['course' => $course->id]) }}" class="btn btn-outline-secondary btn-sm">Редактировать</a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
