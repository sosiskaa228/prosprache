<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Prosprache</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header style="background-color: #1a1a1a;" class="text-white p-3">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="/" class="text-decoration-none"><h4 class="mb-0" style="color: #d4a017;">Prosprache</h4></a>

        <nav class="d-flex align-items-center">
            <a href="/courses" class="text-white me-3 text-decoration-none" style="color='white'">Курсы</a>
            <a href="/teachers" class="text-white me-3 text-decoration-none" style="color='white'">Преподаватели</a>
            @auth
                <div class="d-flex align-items-center ms-3 ps-3">
                    <a href="/home" class="text-white me-3 text-decoration-none fw-bold" style="color='white'">Личный кабинет</a>
                    
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-link text-white me-3 text-decoration-none" style="color='white'">
                            Выйти
                        </button>
                    </form>
                </div>
            @else
                <div class="ms-3 ps-3 ">
                    <a href="/login" class="text-white me-3 text-decoration-none" style="color='white'">Вход</a>
                    <a href="/register" class="text-white me-3 text-decoration-none" style="color='white'">Регистрация</a>
                </div>
            @endauth
        </nav>

    </div>
    </header>

    <main class="container mt-4">
    @yield('content')
    </main>

    <footer style="background-color: #1a1a1a;" class="text-white p-5 mt-5">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            
            <div class="mb-4 mb-md-0 text-center text-md-start">
                <a href="/" class="text-decoration-none">
                    <h4 class="mb-1 fw-bold" style="color: #d4a017;">Prosprache</h4>
                </a>
                <p class="mb-0 text-white-50">Онлайн-школа немецкого языка</p>
            </div>
            <nav class="d-flex flex-wrap justify-content-center gap-4">
                <a href="/about" class="text-white-50 text-decoration-none" style="color='white'">О нас</a>
                <a href="/contacts" class="text-white-50 text-decoration-none" style="color='white'">Контакты</a>
            </nav>

        </div>
        
    </footer>


</body>
</html>