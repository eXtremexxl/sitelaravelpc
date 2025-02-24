@extends('layout')

@section('title', 'Каталог')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="catalog-layout">
        <!-- Фильтр (СЛЕВА) -->
        <div class="filter-section">
            <h3 class="filter-header">Фильтр</h3>
            <form action="{{ route('catalog') }}" method="GET">
                @foreach($components as $category => $items)
                    <div class="filter-category">
                        <summary class="filter-title">{{ $category }}</summary>
                        <div class="filter-options">
                            @foreach($items as $component)
                                <label class="checkbox-container">
                                    <input type="checkbox" name="components[]" value="{{ $component->id }}" 
                                    {{ is_array(request('components')) && in_array($component->id, request('components')) ? 'checked' : '' }}>
                                    <span class="checkmark"></span> {{ $component->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <button type="submit" class="apply-btn">Применить фильтр</button>
                <a href="{{ route('catalog') }}" class="reset-btn">Сбросить</a>
            </form>
        </div>

        <!-- КАТАЛОГ (СПРАВА) -->
        <div class="catalog-container">
            <h1 class="title">Каталог игровых ПК</h1>
            <p class="subtitle">Выберите идеальную машину для игр и работы</p>

            <!-- 🔥 Отображение товаров -->
            <div class="products-grid">
                @forelse($products as $product)
                    <div class="product-cardd">
                        @if($product->created_at >= now()->subDays(1))
                            <span class="badge new">Новинка</span>
                        @endif

                        @if($product->discount_price)
                            <span class="badge discount">-{{ round((1 - ($product->discount_price / $product->price)) * 100) }}%</span>
                        @endif

                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                        <div class="product-info">
                            <h5 class="product-title">{{ $product->name }}</h5>
                            <p class="product-desc">{{ Str::limit($product->description, 80) }}</p>

                            @if($product->discount_price)
                                <p class="old-price">₽{{ number_format($product->price, 2) }}</p>
                                <p class="new-price">₽{{ number_format($product->discount_price, 2) }}</p>
                            @else
                                <p class="price">₽{{ number_format($product->price, 2) }}</p>
                            @endif

                            <a href="{{ route('product.show', $product->id) }}" class="btn">Подробнее</a>
                        </div>
                    </div>
                @empty
                    <p class="no-products">Нет товаров, соответствующих фильтру.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.filter-title').forEach(title => {
        title.addEventListener('click', () => {
            let parent = title.parentElement;
            let options = parent.querySelector('.filter-options');

            parent.classList.toggle('open');

            if (parent.classList.contains('open')) {
                options.style.maxHeight = options.scrollHeight + "px";
            } else {
                options.style.maxHeight = null;
            }
        });
    });
</script>

@endsection
