@extends('base')

@section('content')
<div class="my-5">
    <div class="bg-light p-5 mx-auto border" style="max-width: 800px;">
        
        <h2 class="fw-bold mb-4" style="color: #d4a017;">Урок {{ $lesson->id }}. {{ $lesson->title }}</h2>
        
        <p class="fs-5 mb-5" style="white-space: pre-wrap; line-height: 1.6;">{{ $lesson->description }}</p>
        
        <div class="p-4 mb-5 bg-white" style="border-left: 4px solid #1a1a1a;">
            <h5 class="fw-bold mb-3">Материалы для скачивания:</h5>
            <div class="d-flex align-items-center">
                <a href="#" class="text-decoration-none fw-bold" style="color: #1a1a1a; text-decoration: underline !important;">Скачать материал урока</a>
            </div>
        </div>
        
        <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 pt-4" style="border-top: 1px solid #ddd;">
            <button class="btn btn-outline-success px-4 py-2 fw-bold mb-2">
            Отметить урок как пройденный
            </button>
            
            <a href="/lesson/{{ $lesson->id }}/test" class="btn px-5 py-2 fw-bold mb-2" style="background-color: #d4a017; color: #1a1a1a;">
                Пройти тест 
            </a>
        </div>
    </div>
</div>
@endsection
