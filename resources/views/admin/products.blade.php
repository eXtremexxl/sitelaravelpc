@extends('admin.layout')

@section('title', 'Список товаров')

@section('content')
    <h1>Список товаров</h1>
    
    <a href="{{ route('admin.product.create') }}">Добавить товар</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    
    <table border="1">
    <tr>
        <th>ID</th>
        <th>Фото</th>
        <th>Название</th>
        <th>Описание</th>
        <th>Цена</th>
        <th>Действия</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="50">
            @else
                Нет изображения
            @endif
        </td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->description }}</td>
        <td>{{ $product->price }} руб.</td>
        <td>
            <a href="{{ route('admin.product.edit', $product->id) }}">Редактировать</a> | 
            <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Удалить</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
