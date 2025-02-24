@extends('admin.layout')

@section('title', 'Все заказы')

@section('content')
    <h1 class="text-center">Заказы</h1>

    @if($orders->isEmpty())
        <p class="text-center text-muted">Заказов пока нет.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
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
                                <ul>
                                    @foreach($order->items as $item)
                                        <li>{{ $item->product->name ?? 'Товар удалён' }} (x{{ $item->quantity }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>${{ $order->total_price }}</td>
                            <td>
                                <span class="badge {{ $order->status_class }}">{{ $order->status_text }}</span>
                            </td>
                            <td>
                                <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Ожидание</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>В обработке</option>
                                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Отправлен</option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Доставлен</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Отменён</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm mt-1">Обновить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
