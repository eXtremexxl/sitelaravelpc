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
        <div class="dropdown">
        <a href="{{ url('/catalog') }}" class="small-text">Игровые ПК</a>
            <div class="dropdown-menu">
                <a href="{{ url('/catalog') }}">Все модели</a>
                <a href="{{ url('/configurator') }}">Конфигуратор</a>
            </div>
        </div>

        <div class="dropdown">
            <a href="#">Компоненты</a>
            <div class="dropdown-menu">
                <a href="{{ url('/components/processors') }}">Процессоры</a>
                <a href="{{ url('/components/graphics-cards') }}">Видеокарты</a>
                <a href="{{ url('/components/ram') }}">Оперативная память</a>
                <a href="{{ url('/components/storage') }}">Накопители</a>
                <a href="{{ url('/components/motherboards') }}">Материнские платы</a>
                <a href="{{ url('/components/power-supplies') }}">Блоки питания</a>
            </div>
        </div>

        <div class="dropdown">
            <a href="#">Мониторы</a>
            <div class="dropdown-menu">
                <a href="{{ url('/monitors/full-hd') }}">Full HD</a>
                <a href="{{ url('/monitors/2k') }}">2K</a>
                <a href="{{ url('/monitors/4k') }}">4K</a>
                <a href="{{ url('/monitors/gaming') }}">Игровые мониторы</a>
            </div>
        </div>

        <div class="dropdown">
            <a href="#">Периферия</a>
            <div class="dropdown-menu">
                <a href="{{ url('/peripherals/keyboards') }}">Клавиатуры</a>
                <a href="{{ url('/peripherals/mice') }}">Мыши</a>
                <a href="{{ url('/peripherals/headsets') }}">Гарнитуры</a>
                <a href="{{ url('/peripherals/mousepads') }}">Коврики</a>
            </div>
        </div>
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
        @section('footer')
            <div class="footer-content">
                <p>© {{ date('Y') }} FunnyMoment | Все права защищены</p>
                <p>📍 Адрес: Пермь, ул. Игровая, 15</p>
                <p>📞 Телефон: <a href="tel:+79991234567">+7 (999) 123-45-67</a></p>
                <p>📧 Email: <a href="mailto:support@funnymoment.com">support@funnymoment.com</a></p>
            </div>
            <div class="footer-social">
                <a href="https://vk.com/funnymoment" class="social-link"><i class="fa-brands fa-vk"></i></a>
                <a href="https://t.me/funnymoment" class="social-link"><i class="fa-brands fa-telegram"></i></a>
                <a href="https://youtube.com/@funnymoment" class="social-link"><i class="fa-brands fa-youtube"></i></a>
            </div>
        @show
    </footer>






<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<script>

document.addEventListener('DOMContentLoaded', () => {
  const navbar = document.querySelector('.navbar');
  const burgerMenu = document.querySelector('.burger-menu');
  const dropdowns = document.querySelectorAll('.dropdown');

  // Открытие/закрытие меню
  burgerMenu.addEventListener('click', () => {
    navbar.classList.toggle('active');
  });

  // Закрытие меню при клике вне его области
  document.addEventListener('click', (e) => {
    if (!navbar.contains(e.target) && !burgerMenu.contains(e.target)) {
      navbar.classList.remove('active');
    }
  });

  // Управление выпадающим меню на мобильных устройствах
  dropdowns.forEach(dropdown => {
    const link = dropdown.querySelector('a');
    link.addEventListener('click', (e) => {
      e.preventDefault();
      dropdown.classList.toggle('active');
    });
  });
});


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
