@extends('layout')

@section('title', 'Корзина')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
<div class="cart-container">
    <h1 class="cart-title">🛒 Ваша корзина</h1>
    
    @if($cartItems->isEmpty())
        <p class="empty-cart">Ваша корзина пуста.</p>
    @else
        <div class="cart-items">
            @foreach($cartItems as $item)
                <div class="cart-item">
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="cart-item-img">
                    
                    <div class="cart-item-info">
                        <h5 class="cart-item-title">{{ $item->product->name }}</h5>

                        @if($item->product->discount_price)
                            <p class="cart-item-price original-price">₽{{ number_format($item->product->price, 2) }}</p>
                            <p class="cart-item-price discount-price">₽{{ number_format($item->product->discount_price, 2) }}</p>
                        @else
                            <p class="cart-item-price">₽{{ number_format($item->product->price, 2) }}</p>
                        @endif

                        <form action="{{ route('cart.remove', $item->product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-remove">🗑 Удалить</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="checkout">
            <a href="{{ route('order.index') }}" class="btn btn-success">✅ Оформить заказ</a>
        </div>
    @endif
</div>
@endsection
