<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @yield('head') <!-- Обязательно добавить эту строку -->
</head>
<body class="@yield('body-class')">

<header class="navbar">
    <a href="{{ route('home') }}">
        <div class="logo">
            <img src="{{ asset('imagess/logo.png') }}" alt="Logo">
        </div>
    </a>

    <div class="burger-menu" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <nav>
        <a href="{{ url('/catalog') }}">Каталог</a>
        <a href="#">Компоненты</a>
        <a href="#">Мониторы</a>
        <a href="#">Периферия</a>
    </nav>

    <div class="icons">
        <a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i></a>
        @auth
            <a href="{{ route('order.index') }}"><i class="fas fa-user"></i></a>
        @else
            <a href="{{ route('login') }}"><i class="fas fa-user"></i></a>
        @endauth
    </div>
</header>


<div class="content">
    @yield('content')
</div>

<footer class="footer">
    <div class="footer-content">
        <p>&copy; 2025 FunnyMoment | Все права защищены</p>
        <p>📍 Адрес: Пермь, ул. Игровая, 15</p>
        <p>📞 Телефон: <a href="tel:+79991234567">+7 (999) 123-45-67</a></p>
        <p>📧 Email: <a href="mailto:support@funnymoment.com">support@funnymoment.com</a></p>
    </div>
    <div class="footer-social">
        <a href="#" class="social-link"><i class="fa-brands fa-vk"></i></a>
        <a href="#" class="social-link"><i class="fa-brands fa-telegram"></i></a>
        <a href="#" class="social-link"><i class="fa-brands fa-youtube"></i></a>
    </div>
</footer>






<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">






<script>

function toggleMenu() {
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('active');
}


window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll("a, button").forEach(element => {
        element.addEventListener("click", function(event) {
            const isDisabled = this.hasAttribute("disabled") || this.getAttribute("href") === "#";
            
            if (isDisabled) {
                event.preventDefault(); // Блокируем клик
                this.classList.add("bounce-up"); // Добавляем эффект
                setTimeout(() => this.classList.remove("bounce-up"), 400); // Убираем эффект через 0.4 сек
            }
        });
    });
});
</script>

</body>
</html>
