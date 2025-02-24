@extends('admin.layout')

@section('title', 'Добавить товар')

@section('content')
    <h1>Добавить товар</h1>
    
    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Название:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Описание:</label>
            <textarea name="description" class="form-control" rows="6" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Цена (обычная):</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Цена со скидкой (если есть):</label>
            <input type="number" name="discount_price" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Фото:</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <hr>

        <h4>Комплектующие</h4>
        <div class="row">
            @foreach($components as $category => $items)
                <div class="col-md-6">
                    <h5 class="mt-3">{{ $category }}</h5>
                    <select name="components[]" class="form-select mb-3" multiple>
                        @foreach($items as $component)
                            <option value="{{ $component->id }}">{{ $component->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>

        @if ($errors->has('components'))
            <div class="alert alert-danger mt-2">
                {{ $errors->first('components') }}
            </div>
        @endif

        <button type="submit" class="btn btn-success mt-3">Добавить товар</button>
    </form>

    <style>
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .col-md-6 {
            flex: 1;
            min-width: 300px;
        }
        select.form-select {
            width: 100%;
            height: 120px;
        }
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
    </style>
@endsection
