@extends('layout')

@section('title', $product->name)

@section('head')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="product-container">
        <div class="product">
            <div class="product-image">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                @else
                    <img src="{{ asset('images/no-image.png') }}" alt="Нет фото">
                @endif
            </div>


            <div class="product-info">
                <h1 class="product-title">{{ $product->name }}</h1>
                <p><strong>Описание:</strong> {{ $product->description }}</p>
                <p><strong>Цена:</strong>
                    @if($product->discount_price)
                        <span class="discounted-price">₽{{ number_format($product->discount_price, 2)}}</span>
                        <span class="old-price">₽{{ number_format($product->price, 2)}}</span>
                    @else
                        <span>₽{{ number_format($product->price, 2)}}</span>
                    @endif
                </p>


                <p><strong>Средний рейтинг:</strong> {{ fmod($product->averageRating(), 1) == 0 ? number_format($product->averageRating(), 0) : number_format($product->averageRating(), 1) }}/5</p>

                <div class="button-group">
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Добавить в корзину</button>
                </form>
                <a href="{{ route('catalog') }}" class="btn btn-secondary">Назад к каталогу</a>
            </div>

            </div>
        </div>

        <h3 class="section-title">🔧 Комплектующие</h3>
        <ul class="components-list">
            @foreach($product->components as $component)
                <li class="component-item">
                    <strong>{{ $component->category }}:</strong> {{ $component->name }}
                </li>
            @endforeach
        </ul>

        <h2 class="section-title">Отзывы</h2>
        <div class="reviews">
            @foreach($product->reviews as $review)
            <div class="review-card">
                <p><strong>{{ $review->user->name }}</strong> оставил отзыв:</p>
                <p><strong>Оценка:</strong> {{ $review->rating }}/5</p>
                <p>{{ $review->comment }}</p>
                <p><small>Обновлено: {{ $review->updated_at->format('d.m.Y H:i') }}</small></p>

                @if(Auth::check() && $review->user_id === Auth::id())
                    <a href="{{ route('review.edit', $review->id) }}" class="btn btn-outline-primary">✏️ Редактировать</a>
                @endif
            </div>
            @endforeach
        </div>

        @if(!$product->reviews->where('user_id', Auth::id())->count())
            <h2 class="section-title">Оставьте отзыв</h2>
            <form action="{{ route('review.store', $product->id) }}" method="POST" class="review-form">
                @csrf
                <label for="rating">Оценка (1-5):</label>
                <input type="number" name="rating" min="1" max="5" required>

                <label for="comment">Комментарий:</label>
                <textarea name="comment" rows="3" required></textarea>

                <button type="submit" class="btn btn-primary">Отправить отзыв</button>
            </form>
        @endif
    </div>
</div>
@endsection
