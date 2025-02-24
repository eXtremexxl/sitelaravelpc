<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;

Route::get('/qwe', function () {
    return view('qwe');
});


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/catalog', [ProductController::class, 'index'])->name('catalog');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/admin/product/create', [AdminController::class, 'createProduct'])->name('admin.product.create');
    Route::post('/admin/product/store', [AdminController::class, 'storeProduct'])->name('admin.product.store');
    Route::get('/admin/product/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.product.edit');
    Route::put('/admin/product/{id}', [AdminController::class, 'updateProduct'])->name('admin.product.update');
    Route::delete('/admin/product/{id}', [AdminController::class, 'deleteProduct'])->name('admin.product.delete');
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::put('/admin/order/{id}', [AdminController::class, 'updateOrder'])->name('admin.order.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/components', [ComponentController::class, 'index'])->name('admin.components');
    Route::get('/admin/components/create', [ComponentController::class, 'create'])->name('admin.components.create');
    Route::post('/admin/components', [ComponentController::class, 'store'])->name('admin.components.store');
    Route::get('/admin/components/{id}/edit', [ComponentController::class, 'edit'])->name('admin.components.edit');
    Route::put('/admin/components/{id}', [ComponentController::class, 'update'])->name('admin.components.update');
    Route::delete('/admin/components/{id}', [ComponentController::class, 'destroy'])->name('admin.components.destroy');
});

// Вывод списка комплектующих для пользователей
Route::get('/components', [ComponentController::class, 'list'])->name('components.list');



Route::post('/product/{id}/review', [ReviewController::class, 'store'])
    ->middleware('auth')->name('review.store');

Route::get('/review/{id}/edit', [ReviewController::class, 'edit'])
    ->middleware('auth')->name('review.edit'); // редакт

Route::put('/review/{id}', [ReviewController::class, 'update'])
    ->middleware('auth')->name('review.update');


Route::get('/catalog', [ProductController::class, 'index'])->name('catalog');

// Управление комплектующими (только для админа)

