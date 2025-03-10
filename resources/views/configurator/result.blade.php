@extends('layout')

@section('title', 'Результат')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/sborka.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Динамический фон для body */
        body.compatible {
            background: linear-gradient(135deg, #22c55e, #16a34a); /* Зеленый градиент */
        }
        body.incompatible {
            background: linear-gradient(135deg, #b50e30, #ea1343); /* Красный градиент */
        }
    </style>
@endsection

@section('content')
    <div class="configurator-container">
        <body class="{{ $compatibility['status'] ? 'compatible' : 'incompatible' }}">
            <h1>Ваша сборка</h1>
            <div class="result-container">
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
                <div class="total-info">
                    <p>Общая стоимость: <span class="highlight">{{ number_format($totalPrice, 0, ',', ' ') }} руб.</span></p>
                    <div class="benchmark-container">
                        <canvas id="benchmarkChart" width="100" height="100"></canvas>
                        <p>Производительность: <span class="highlight">{{ $benchmarkScore }}</span></p>
                    </div>
                </div>
                @if (!$compatibility['status'])
                    <div class="alert alert-danger">
                        <h3>Проблемы совместимости:</h3>
                        <ul>
                            @foreach ($compatibility['messages'] as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="alert alert-success">Сборка совместима!</div>
                @endif
                <button class="btn btn-copy" onclick="copyBuild()">
                    <i class="fas fa-copy"></i> Скопировать сборку
                </button>
                <div id="copy-notification" class="copy-notification">Сборка скопирована!</div>
            </div>
        </body>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Круговая диаграмма производительности без интерактивности
        const ctx = document.getElementById('benchmarkChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [{{ $benchmarkScore }}, 100 - {{ $benchmarkScore }}],
                    backgroundColor: ['#ea1343', 'rgba(68, 68, 84, 0.7)'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '70%',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                },
                events: []
            }
        });

        // Копирование сборки в буфер обмена
        function copyBuild() {
            const buildText = `@foreach ($components as $component)
{{ $component->category }}: {{ $component->name }} ({{ number_format($component->price, 0, ',', ' ') }} руб.)
@endforeach
Общая стоимость: {{ number_format($totalPrice, 0, ',', ' ') }} руб.
Производительность: {{ $benchmarkScore }}`;
            navigator.clipboard.writeText(buildText);
            const notification = document.getElementById('copy-notification');
            notification.classList.add('show');
            setTimeout(() => notification.classList.remove('show'), 2000);
        }
    </script>
@endsection

@section('footer')
    <!-- Можно добавить футер -->
@endsection