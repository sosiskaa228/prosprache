@extends('base')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Создать курс</h2>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('teacher.courses.store') }}" class="card">
        @csrf
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Название</label>
                <input
                    name="title"
                    class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}"
                    required
                >

                @error('title')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea
                    name="description"
                    class="form-control @error('description') is-invalid @enderror"
                    rows="5" required
                >{{ old('description') }}</textarea>

                @error('description')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="btn btn-success">Создать</button>
        </div>
    </form>
</div>
@endsection