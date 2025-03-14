@extends('admin.layout')

@section('title', 'Главная')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Добро пожаловать в админ-панель</h1>
            <span class="badge bg-primary">Дата: {{ date('d.m.Y') }}</span>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card dashboard-card p-4 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-primary me-3">
                            <i class="bi bi-box-seam fs-2 text-white"></i>
                        </div>
                        <div>
                            <h5 class="text-muted">Товары</h5>
                            <p class="display-6 mb-0 counter" data-target="{{ $productsCount }}">0</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.products') }}" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card dashboard-card p-4 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-success me-3">
                            <i class="bi bi-cart-check fs-2 text-white"></i>
                        </div>
                        <div>
                            <h5 class="text-muted">Заказы</h5>
                            <p class="display-6 mb-0 counter" data-target="{{ $ordersCount }}">0</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.orders') }}" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card dashboard-card p-4 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-info me-3">
                            <i class="bi bi-people fs-2 text-white"></i>
                        </div>
                        <div>
                            <h5 class="text-muted">Пользователи</h5>
                            <p class="display-6 mb-0 counter" data-target="{{ $usersCount }}">0</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.users') }}" class="stretched-link"></a>
                </div>
            </div>
        </div>

        <!-- Дополнительный прикол: быстрые статистики -->
        <div class="row g-4 mt-2">
            <div class="col-md-6">
                <div class="card p-4">
                    <h5 class="mb-3">Последние заказы</h5>
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: {{ ($ordersCount > 0 ? ($ordersCount / 100) * 100 : 0) }}%;" 
                             aria-valuenow="{{ $ordersCount }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                            {{ $ordersCount }}%
                        </div>
                    </div>
                    <small class="text-muted mt-2 d-block">Выполнено за сегодня</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-4">
                    <h5 class="mb-3">Популярный товар</h5>
                    @if($popularProduct)
                        <div class="d-flex align-items-center">
                            <img src="{{ $popularProduct->image ? asset('storage/' . $popularProduct->image) : asset('images/placeholder.jpg') }}" 
                                 class="rounded me-3" 
                                 style="width: 50px; height: 50px; object-fit: cover;" 
                                 alt="{{ $popularProduct->name }}">
                            <div>
                                <p class="mb-0 fw-bold">{{ $popularProduct->name }}</p>
                                <small class="text-muted">Продано: {{ $popularProduct->orders_count }} шт.</small>
                            </div>
                        </div>
                    @else
                        <p class="text-muted mb-0">Нет данных</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    

    <style>
        .dashboard-card {
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stretched-link::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1;
            content: "";
        }

        .progress-bar {
            transition: width 1s ease-in-out;
        }
    </style>

    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const updateCounter = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText;
                    const speed = 200;
                    const increment = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment);
                        setTimeout(updateCounter, 10);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCounter();
            });
        });
    </script>
@endsection