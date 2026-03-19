@extends('base')

@section('content')
<h2 class="mb-5 px-2 text-center">Преподаватели</h2>
<div class="row text-center gy-5">

    @foreach($teachers as $teacher)
    <div class="col-md-4">
        <div>
            <img src="/images/teachers/{{ $teacher->photo }}" 
                 class="mb-3" 
                 style="width: 140px; height: 140px; object-fit: cover; border-radius: 50%;" 
                 alt="{{ $teacher->user->name }}">
                 
            <h4 style="color: #d4a017;">{{ $teacher->user->name }}</h4>
            <p class="text-muted mb-2">Опыт: {{ $teacher->experience }}</p>
            <a href="/teachers/{{ $teacher->id }}" class="text-decoration-none text-secondary">Перейти к профилю</a>
        </div>
    </div>
    @endforeach

</div>
@endsection
