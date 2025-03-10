<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'discount_price', 'image'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
    
    public function components()
    {
        return $this->belongsToMany(Component::class, 'component_product');
    }

    // Связь с элементами заказов
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    // Связь с заказами через OrderItem
    public function orders()
    {
        return $this->hasManyThrough(
            Order::class,           // Целевая модель
            OrderItem::class,       // Промежуточная модель
            'product_id',           // Внешний ключ в OrderItem, указывающий на Product
            'id',                   // Ключ в Order
            'id',                   // Локальный ключ в Product
            'order_id'              // Внешний ключ в OrderItem, указывающий на Order
        );
    }
}