@extends('admin.layout')

@section('title', 'Редактировать товар')

@section('content')
    <h1>Редактировать товар</h1>
    
    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Название:</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Описание:</label>
            <textarea name="description" class="form-control" rows="6" required>{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Цена (обычная):</label>
            <input type="number" name="price" value="{{ $product->price }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Цена со скидкой (если есть):</label>
            <input type="number" name="discount_price" value="{{ $product->discount_price }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Фото:</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            @if($product->image)
                <p class="mt-2">Текущее изображение:</p>
                <img src="{{ asset('storage/' . $product->image) }}" width="150">
            @endif
        </div>

        <hr>

        <h4>Комплектующие</h4>
        <div class="row">
            @foreach($components as $category => $items)
                <div class="col-md-6">
                    <h5 class="mt-3">{{ $category }}</h5>
                    <select name="components[]" class="form-select mb-3" multiple>
                        @foreach($items as $component)
                            <option value="{{ $component->id }}" 
                                {{ $product->components->contains($component->id) ? 'selected' : '' }}>
                                {{ $component->name }}
                            </option>
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

        <button type="submit" class="btn btn-primary mt-3">Обновить</button>
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
