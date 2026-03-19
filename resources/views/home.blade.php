@extends('base')

@section('content')
<div class="my-5 mx-auto" style="max-width: 600px;">
    <h2 class="fw-bold mb-4" style="color: #d4a017;">Личный кабинет</h2>
    
    <div class="bg-light p-5 border">

        <h5 class="fw-bold mb-3 border-bottom pb-2">Мои уроки:</h5>
        
        <a href="/lesson/1" class="d-block mb-4 text-decoration-none" style="color: #1a1a1a; font-size: 1.1rem; font-weight: 500;">
            Урок 1. Основы грамматики немецкого
        </a>
    </div>
</div>
@endsection
