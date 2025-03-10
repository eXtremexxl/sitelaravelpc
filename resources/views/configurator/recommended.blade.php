@extends('layout')

@section('title', 'Рекомендации')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/recommend.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endsection

@section('content')
    <div class="configurator-container">
        <h1>Рекомендуемые сборки</h1>
        <div class="recommended-container">
            <form method="GET" class="budget-form">
                <div class="input-group">
                    <div class="budget-wrapper">
                        <span class="currency-icon"><i class="fas fa-ruble-sign"></i></span>
                        <input type="number" name="budget" placeholder="Ваш бюджет (руб.)" value="{{ request('budget', 50000) }}" min="1000" step="1000" class="budget-input" id="budget-input">
                        <select class="budget-presets" onchange="document.getElementById('budget-input').value = this.value; this.form.submit();">
                            <option value="" disabled selected>Пресеты</option>
                            <option value="30000">Бюджетный (30,000 руб.)</option>
                            <option value="50000">Средний (50,000 руб.)</option>
                            <option value="100000">Премиум (100,000 руб.)</option>
                        </select>
                    </div>
                    <input type="range" min="1000" max="200000" step="1000" value="{{ request('budget', 50000) }}" class="budget-slider" id="budget-slider" oninput="document.getElementById('budget-input').value = this.value;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-rocket"></i> Подобрать
                    </button>
                </div>
            </form>
            @if ($components->isEmpty())
                <p class="no-results">Введите бюджет, чтобы увидеть рекомендации.</p>
            @else
                <div class="budget-progress">
                    <div class="progress-bar" style="width: {{ ($components->sum('price') / request('budget', 50000)) * 100 }}%;"></div>
                    <span class="progress-text">
                        Использовано: {{ number_format($components->sum('price'), 0, ',', ' ') }} из {{ number_format(request('budget', 50000), 0, ',', ' ') }} руб.
                    </span>
                </div>
                <ul class="component-list">
                    @foreach ($components as $component)
                        <li class="component-item" data-category="{{ strtolower($component->category) }}">
                            <span class="category-icon">
                                <i class="fas {{ $component->category === 'CPU' ? 'fa-microchip' : ($component->category === 'GPU' ? 'fa-video' : 'fa-memory') }}"></i>
                            </span>
                            <span class="category">{{ $component->category }}:</span>
                            <span class="name">{{ $component->name }}</span>
                            <span class="price">({{ number_format($component->price, 0, ',', ' ') }} руб.)</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <script>
        // Синхронизация ползунка и поля ввода
        document.getElementById('budget-input').addEventListener('input', function() {
            document.getElementById('budget-slider').value = this.value;
        });
    </script>
@endsection

@section('footer')
    <!-- Можно добавить футер, если нужно -->
@endsection