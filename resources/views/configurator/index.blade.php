@extends('layout')

@section('title', 'Конфигуратор')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/configurator.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
    <div class="configurator-container">
        <h1>Конфигуратор ПК</h1>
        <form id="configurator-form" action="{{ route('configurator.configure') }}" method="POST">
            @csrf
            <div class="filters">
                <select name="filter_brand" onchange="filterComponents()">
                    <option value="">Все бренды</option>
                    <option value="Intel">Intel</option>
                    <option value="AMD">AMD</option>
                </select>
            </div>
            @foreach ($components as $category => $items)
                <div class="form-group">
                    <label>{{ $category }}</label>
                    <select name="components[]" class="component-select" data-category="{{ $category }}">
                        <option value="">Выберите {{ $category }}</option>
                        @foreach ($items as $component)
                            <option value="{{ $component->id }}"
                                    data-price="{{ $component->price }}"
                                    data-benchmark="{{ $component->benchmark_score ?? 0 }}"
                                    data-brand="{{ explode(' ', $component->name)[0] }}"
                                    data-socket="{{ $component->socket }}">
                                {{ $component->name }} ({{ $component->price }} руб.)
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
            <div class="total-info">
                Total: <span id="total-price">0</span> руб. | Benchmark: <span id="benchmark-score">0</span>
            </div>
            <div id="compatibility"></div>
            <canvas id="benchmarkChart" style="max-height: 300px; margin-top: 20px;"></canvas>
            <div class="button-group">
                <button type="submit" class="btn btn-primary">Результат сборки</button>
                <button type="button" onclick="downloadConfig()" class="btn btn-secondary">Скачать PDF</button>
                <a href="{{ route('configurator.recommended') }}" class="btn btn-outline-primary">Рекомендуемые сборки</a>
            </div>
        </form>
    </div>
    @section('footer')

    @endsection

    <script>
        // Инициализация графика
        const ctx = document.getElementById('benchmarkChart').getContext('2d');
        let benchmarkChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Производительность',
                    data: [],
                    backgroundColor: '#28a745',
                    borderColor: '#28a745',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true, title: { display: true, text: 'Бенчмарк', color: '#ffffff' } },
                    x: { title: { display: true, text: 'Компоненты', color: '#ffffff' } }
                },
                plugins: { legend: { display: false }, tooltip: { enabled: true } },
                maintainAspectRatio: false
            }
        });

        function calculateLocalTotals() {
            let totalPrice = 0;
            let totalBenchmark = 0;
            const chartLabels = [];
            const chartData = [];

            document.querySelectorAll('.component-select').forEach(select => {
                const selectedOption = select.options[select.selectedIndex];
                if (selectedOption && selectedOption.value) {
                    const price = parseFloat(selectedOption.dataset.price) || 0;
                    const benchmark = parseFloat(selectedOption.dataset.benchmark) || 0;
                    totalPrice += price;
                    totalBenchmark += benchmark;
                    chartLabels.push(select.dataset.category);
                    chartData.push(benchmark);
                }
            });

            document.getElementById('total-price').textContent = totalPrice.toFixed(2);
            document.getElementById('benchmark-score').textContent = totalBenchmark;
            benchmarkChart.data.labels = chartLabels;
            benchmarkChart.data.datasets[0].data = chartData;
            benchmarkChart.update();
        }

        function updateConfig() {
            calculateLocalTotals();
            let data = new FormData(document.getElementById('configurator-form'));
            fetch('{{ route('configurator.check') }}', {
                method: 'POST',
                body: data,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('total-price').textContent = data.totalPrice.toFixed(2);
                document.getElementById('benchmark-score').textContent = data.benchmarkScore || 0;
                let compatibilityDiv = document.getElementById('compatibility');
                compatibilityDiv.innerHTML = data.status ? '<p class="text-success">Сборка совместима!</p>' : 
                    '<ul class="text-danger">' + data.compatibilityMessages.map(msg => `<li>${msg}</li>`).join('') + '</ul>';
                compatibilityDiv.classList.add('fade-in');
                setTimeout(() => compatibilityDiv.classList.remove('fade-in'), 500);
            })
            .catch(error => console.error('Ошибка:', error));
        }

        function filterComponents() {
            let brand = document.querySelector('[name="filter_brand"]').value;
            document.querySelectorAll('.component-select option').forEach(option => {
                option.style.display = (!brand || option.dataset.brand === brand) ? 'block' : 'none';
            });
            calculateLocalTotals();
        }

        function downloadConfig() {
            let data = new FormData(document.getElementById('configurator-form'));
            fetch('{{ route('configurator.download') }}', {
                method: 'POST',
                body: data,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(response => {
                if (!response.ok) throw new Error('Ошибка при скачивании');
                return response.blob();
            })
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'PC_Configuration.pdf';
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            })
            .catch(error => alert('Ошибка при скачивании: ' + error.message));
        }

        function updateCompatibleOptions() {
            const selectedIds = [];
            document.querySelectorAll('.component-select').forEach(select => {
                if (select.value) selectedIds.push(select.value);
            });

            fetch('{{ route('configurator.compatible') }}?selected=' + encodeURIComponent(JSON.stringify(selectedIds)), {
                method: 'GET',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(response => response.json())
            .then(compatibleComponents => {
                document.querySelectorAll('.component-select').forEach(select => {
                    const category = select.dataset.category;
                    const currentSelection = select.value;
                    const compatibleItems = compatibleComponents[category] || [];
                    select.innerHTML = '<option value="">Выберите ' + category + '</option>';
                    compatibleItems.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id;
                        option.text = `${item.name} (${item.price} руб.)`;
                        option.dataset.price = item.price;
                        option.dataset.benchmark = item.benchmark_score || 0;
                        option.dataset.socket = item.socket;
                        if (item.id == currentSelection) option.selected = true;
                        select.appendChild(option);
                    });
                });
                calculateLocalTotals();
                updateConfig();
            })
            .catch(error => console.error('Ошибка загрузки совместимых компонентов:', error));
        }

        document.querySelectorAll('.component-select').forEach(select => {
            select.addEventListener('change', () => {
                updateConfig();
                updateCompatibleOptions();
            });
        });
        updateConfig(); // Инициализация
    </script>
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        #benchmarkChart {
            background: #3a3a48;
            padding: 10px;
            border-radius: 12px;
        }
    </style>
@endsection