<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ComponentController; // Предполагаем, что контроллер существует
use App\Http\Controllers\ConfiguratorController;

// Тестовый маршрут
Route::get('/qwe', function () {
    return view('qwe');
});

// Публичные маршруты
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [ProductController::class, 'index'])->name('catalog');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::get('/components', [ComponentController::class, 'list'])->name('components.list');

Route::get('/configurator', [ConfiguratorController::class, 'index'])->name('configurator.index');
Route::post('/configurator/configure', [ConfiguratorController::class, 'configure'])->name('configurator.configure');
Route::post('/configurator/check', [ConfiguratorController::class, 'checkCompatibilityAjax'])->name('configurator.check');
Route::get('/configurator/compatible', [ConfiguratorController::class, 'getCompatibleComponents'])->name('configurator.compatible');
Route::post('/configurator/save', [ConfiguratorController::class, 'saveConfiguration'])->name('configurator.save');
Route::get('/configurator/recommended', [ConfiguratorController::class, 'recommended'])->name('configurator.recommended');
Route::post('/configurator/download', [ConfiguratorController::class, 'download'])->name('configurator.download');

// Аутентификация
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Отзывы (требуется авторизация)
Route::post('/product/{id}/review', [ReviewController::class, 'store'])->middleware('auth')->name('review.store');
Route::get('/review/{id}/edit', [ReviewController::class, 'edit'])->middleware('auth')->name('review.edit');
Route::put('/review/{id}', [ReviewController::class, 'update'])->middleware('auth')->name('review.update');

// Админ-панель (требуется авторизация и роль администратора)
Route::middleware(['auth', 'admin'])->group(function () {
    // Главная страница админ-панели
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Товары
    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/admin/product/create', [AdminController::class, 'createProduct'])->name('admin.product.create');
    Route::post('/admin/product/store', [AdminController::class, 'storeProduct'])->name('admin.product.store');
    Route::get('/admin/product/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.product.edit');
    Route::put('/admin/product/{id}', [AdminController::class, 'updateProduct'])->name('admin.product.update');
    Route::delete('/admin/product/{id}', [AdminController::class, 'deleteProduct'])->name('admin.product.delete');

    // Заказы
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::put('/admin/order/{id}', [AdminController::class, 'updateOrder'])->name('admin.order.update');

    // Пользователи (новый маршрут)
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

});