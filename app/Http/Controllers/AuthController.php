<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    // Форма входа
    public function showLoginForm() {
        return view('auth.login');
    }

    // Авторизация пользователя
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with('success', 'Вы успешно вошли!');
        }

        return back()->with('error', 'Неверные данные');
    }

    // Выход
    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }

    // Форма регистрации
    public function showRegisterForm() {
        return view('auth.register');
    }

    // Регистрация нового пользователя
    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Регистрация успешна! Теперь войдите в аккаунт.');
    }
}
