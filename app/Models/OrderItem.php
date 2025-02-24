<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // Связь: элемент заказа принадлежит заказу
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Связь: элемент заказа принадлежит продукту
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
