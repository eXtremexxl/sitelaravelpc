@extends('layout')

@section('title', 'Вход / Регистрация')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-icons@1.13.12/iconfont/material-icons.min.css">
@endsection

@section('content')
<section>
    <div class="container">
        <div class="row full-screen align-items-center">
            <div class="left">
                <span class="line"></span>
                <h2>Идеальный <span>игровой ПК</span> для тебя</h2>  
                <p>Собираем и продаем мощные компьютеры для игр и работы</p>  
                <a href="{{ url('/catalog') }}" class="btn">Выбрать ПК</a>

            </div>

            <div class="right">
                <div class="form">
                    <div class="text-center">
                        <h6><span>Вход</span><span>Регистрация</span></h6>
                        <input type="checkbox" class="checkbox" id="reg-log">
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap">
                            <div class="card-3d-wrapper">
                                <!-- Форма входа -->
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <h4 class="heading">Вход</h4>
                                        <form action="{{ route('login') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-style" placeholder="Ваш Email" required>
                                                <i class="input-icon material-icons">alternate_email</i>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-style" placeholder="Ваш пароль" required>
                                                <i class="input-icon material-icons">lock</i>
                                            </div>
                                            <button type="submit" class="btn">Войти</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Форма регистрации -->
                                <div class="card-back">
                                    <div class="center-wrap">
                                        <h4 class="heading">Регистрация</h4>
                                        <form action="{{ route('register') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-style" placeholder="Ваше имя" required>
                                                <i class="input-icon material-icons">perm_identity</i>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-style" placeholder="Ваш Email" required>
                                                <i class="input-icon material-icons">alternate_email</i>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-style" placeholder="Ваш пароль" required>
                                                <i class="input-icon material-icons">lock</i>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password_confirmation" class="form-style" placeholder="Подтвердите пароль" required>
                                                <i class="input-icon material-icons">lock</i>
                                            </div>
                                            <button type="submit" class="btn">Зарегистрироваться</button>
                                        </form>
                                    </div>
                                </div> <!-- card-back -->
                            </div> <!-- card-3d-wrapper -->
                        </div> <!-- card-3d-wrap -->
                    </div>
                </div>    
            </div>
        </div>
    </div>
</section>
@endsection
