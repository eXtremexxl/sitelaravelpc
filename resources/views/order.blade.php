@extends('layout')

@section('title', 'Оформление заказа')


@section('head')
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
@endsection

@section('content')
<div class="wrapper">
    <div class="container">
        <h1 class="title">📦 Оформление заказа</h1>

        @if($cartItems->isEmpty())
            <p class="empty-cart">Ваша корзина пуста.</p>
        @else
            <div class="products">
                @foreach($cartItems as $item)
                    <div class="product-card">
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                        <div class="product-info">
                            <h5>{{ $item->product->name }}</h5>

                            @if($item->product->discount_price)
                                <p class="old-price">₽{{ number_format($item->product->price, 2) }}</p>
                                <p class="new-price">₽{{ number_format($item->product->discount_price, 2) }}</p>
                            @else
                                <p class="new-price">₽{{ number_format($item->product->price, 2) }}</p>
                            @endif

                            <p class="quantity">Количество: {{ $item->quantity }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="confirm">
                <form action="{{ route('order.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn">✅ Подтвердить заказ</button>
                </form>
            </div>
        @endif

        <hr class="divider">

        <h2 class="title">📝 Ваши заказы</h2>
        @if($orders->isEmpty())
            <p class="empty-cart">У вас пока нет заказов.</p>
        @else
            <div class="orders">
                @foreach($orders as $order)
                    <div class="order-card">
                        <h4>📦 Заказ #{{ $order->id }} ({{ number_format($order->total_price, 2) }}₽)</h4>
                        <p>
                            <strong>Статус:</strong> 
                            <span class="status {{ $order->status_class }}">
                                {{ strtoupper($order->status_text) }}
                            </span>
                        </p>

                        <ul>
                            @foreach($order->items as $item)
                                <li>{{ $item->product->name }} (x{{ $item->quantity }})</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>


        <!-- Отображение пагинации -->
        <div class="pagination">
            <ul class="pagination">
                @if ($orders->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">←</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $orders->previousPageUrl() }}">←</a></li>
                @endif
                
                @foreach ($orders->links() as $link)
                    <li class="page-item {{ $link->active ? 'active' : '' }}">
                        <a class="page-link" href="{{ $link->url }}">{{ $link->label }}</a>
                    </li>
                @endforeach
                
                @if ($orders->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $orders->nextPageUrl() }}">→</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link">→</span></li>
                @endif
            </ul>
        </div>


        @endif
    </div>
    <div class="logout">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-logout">🚪 Выйти</button>
        </form>
    </div>

</div>
@endsection
