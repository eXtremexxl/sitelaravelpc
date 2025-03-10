@extends('admin.layout')

@section('title', 'Список товаров')

@section('content')
    <div class="container-fluid">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Список товаров</h1>
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Добавить товар</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Фото</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Цена</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="rounded" width="50">
                                    @else
                                        <span class="text-muted">Нет фото</span>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ Str::limit($product->description, 50) }}</td>
                                <td>{{ $product->price }} руб.</td>
                                <td>
                                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-primary">Редактировать</a>
                                    <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Уверены?')">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection