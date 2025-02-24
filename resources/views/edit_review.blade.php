@extends('layout')

@section('title', 'Редактирование отзыва')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')

    <form action="{{ route('review.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="rating">Оценка (1-5):</label>
        <input type="number" name="rating" value="{{ $review->rating }}" min="1" max="5" required>

        <label for="additional_comment">Дополнение к отзыву:</label>
        <textarea name="additional_comment" required></textarea>

        <button type="submit">Обновить отзыв</button>
    </form>

    <a href="{{ route('product.show', $review->product_id) }}" class="back-link">Назад</a>

@endsection
