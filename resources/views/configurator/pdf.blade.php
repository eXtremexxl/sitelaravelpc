<!DOCTYPE html>
<html>
<head>
            <meta charset="UTF-8">
            <title>Конфигурация ПК</title>
            <style>
                @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/fonts/dejavu-sans/DejaVuSans.ttf') format('truetype');
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        h1 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; margin-top: 10px; }
        .compatibility { margin-top: 20px; }
        .success { color: green; }
        .danger { color: red; }
    </style>
</head>
<body>
    <h1>Конфигурация ПК</h1>
    <table>
        <thead>
            <tr>
                <th>Категория</th>
                <th>Название</th>
                <th>Цена (руб.)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($components as $component)
                <tr>
                    <td>{{ $component->category }}</td>
                    <td>{{ $component->name }}</td>
                    <td>{{ $component->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="total">Общая стоимость: {{ $totalPrice }} руб.</div>
    <div class="total">Производительность: {{ $benchmarkScore }}</div>
    <div class="compatibility">
        @if ($compatibility['status'])
            <p class="success">Сборка совместима!</p>
        @else
            <p class="danger">Проблемы совместимости:</p>
            <ul>
                @foreach ($compatibility['messages'] as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>