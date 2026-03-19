@extends('base')

@section('content')
<div class="mt-5">
    <h1 class="fw-bold mb-4" style="color: #d4a017;">Контакты</h1>
    
    <div class="fs-5" style="max-width: 800px;">
        <p class="mb-5">Свяжитесь с нами для консультации и подбора курса. Мы быстро отвечаем!</p>
        
        <div class="mb-4">
            <span class="text-muted fs-6 d-block mb-1">Telegram (самый быстрый ответ)</span>
            <span class="text-decoration-none fw-bold" style="color: #1a1a1a;">
                @prosprache_support
            </span>
        </div>
        
        <div class="mb-4">
            <span class="text-muted fs-6 d-block mb-1">Электронная почта</span>
            <span class="text-decoration-none fw-bold" style="color: #1a1a1a;">
                info@prosprache.ru
            </span>
        </div>
        
        <div class="mb-4">
            <span class="text-muted fs-6 d-block mb-1">Телефон горячей линии</span>
            <span class="fw-bold" style="color: #1a1a1a;">
                +375 (29) 164-23-47
            </span>
        </div>
    </div>
</div>
@endsection
