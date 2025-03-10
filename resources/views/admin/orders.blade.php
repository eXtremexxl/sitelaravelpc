@extends('admin.layout')

@section('title', 'Все заказы')

@section('content')
    <div class="container-fluid">
        <div class="card p-4">
            <h1 class="mb-4">Заказы</h1>

            @if($orders->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle me-2"></i>Заказов пока нет
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>№ Заказа</th>
                                <th>Пользователь</th>
                                <th>Товары</th>
                                <th>Сумма</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->user->name ?? 'Гость' }}</td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            @foreach($order->items as $item)
                                                <li>{{ $item->product->name ?? 'Товар удалён' }} (x{{ $item->quantity }})</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>${{ $order->total_price }}</td>
                                    <td>
                                        <span class="badge status-badge {{ $order->status }}-badge">
                                            {{ $order->status_text }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.order.update', $order->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select form-select-sm status-select">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Ожидание</option>
                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>В обработке</option>
                                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Отправлен</option>
                                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Доставлен</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Отменён</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Обновить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <style>
        .status-badge {
            padding: 6px 12px;
            font-size: 14px;
            border-radius: 12px;
            font-weight: 500;
        }

        .pending-badge {
            background-color: #ffeaa7;
            color: #745210;
        }

        .processing-badge {
            background-color: #74c0fc;
            color: #0c3266;
        }

        .shipped-badge {
            background-color: #a29bfe;
            color: #2d2755;
        }

        .delivered-badge {
            background-color: #95de64;
            color: #224d10;
        }

        .cancelled-badge {
            background-color: #ff8787;
            color: #5e1a1a;
        }

        .status-select {
            max-width: 120px;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table td {
            vertical-align: middle;
        }
    </style>
@endsection