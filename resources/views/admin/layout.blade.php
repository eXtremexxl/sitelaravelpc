<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>
    <nav>
        <a href="{{ route('admin.dashboard') }}">Главная</a> 
        <a href="{{ route('admin.products') }}">Товары</a> 
        <a href="{{ route('admin.orders') }}">Заказы</a>
        <a href="{{ route('home') }}">На сайт</a> 
    </nav>
    <hr>
    @yield('content')
</body>
</html>
