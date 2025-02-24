<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price', 'status'];

    // Доступные статусы заказа
    public static function getAvailableStatuses()
    {
        return [
            'pending' => 'В ожидании',
            'processing' => 'В обработке',
            'shipped' => 'Отправлен',
            'delivered' => 'Доставлен',
            'cancelled' => 'Отменён',
        ];
    }

    public function getStatusClassAttribute()
    {
        return match ($this->status) {
            'pending' => 'badge-pending',
            'processing' => 'badge-processing',
            'shipped' => 'badge-shipped',
            'delivered' => 'badge-delivered',
            'cancelled' => 'badge-cancelled',
            default => 'badge-secondary',
        };
    }


    // Человеко-читаемый статус заказа
    public function getStatusTextAttribute()
    {
        return self::getAvailableStatuses()[$this->status] ?? $this->status;
    }

    // Связь: заказ имеет много товаров
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
