@extends('admin.layout')

@section('title', 'Добавить товар')

@section('content')
    <div class="container-fluid">
        <div class="card p-4">
            <h1 class="mb-4">Добавить товар</h1>
            
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Название:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Фото:</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Описание:</label>
                        <textarea name="description" class="form-control" rows="6" required></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Цена (обычная):</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Цена со скидкой:</label>
                        <input type="number" name="discount_price" class="form-control">
                    </div>

                    <div class="col-12">
                        <hr>
                        <h4 class="mb-3">Комплектующие</h4>
                        <div class="row">
                            @foreach($components as $category => $items)
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">{{ $category }}</label>
                                    <select name="components[]" class="form-select" multiple>
                                        @foreach($items as $component)
                                            <option value="{{ $component->id }}">{{ $component->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if ($errors->has('components'))
                        <div class="alert alert-danger mt-2">
                            {{ $errors->first('components') }}
                        </div>
                    @endif

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-success">Добавить товар</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .form-control, .form-select {
            border-radius: 8px;
        }
        .btn-success {
            padding: 10px 30px;
            border-radius: 8px;
        }
    </style>
@endsection