<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {
    // Страница оформления заказа
    public function index() {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        
        // Пагинация для заказов - 5 заказов на страницу
        $orders = Order::where('user_id', Auth::id())->with('items.product')->paginate(8);
    
        return view('order', compact('cartItems', 'orders'));
    }

    // Оформление заказа
    public function checkout() {
        $cartItems = Cart::where('user_id', Auth::id())->get();
    
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Ваша корзина пуста');
        }
    
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity),
            'status' => 'processing',
        ]);
    
        // Переносим товары из корзины в order_items
        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }
    
        // Очищаем корзину
        Cart::where('user_id', Auth::id())->delete();
    
        return redirect()->route('home')->with('success', 'Заказ успешно оформлен!');
    }
}
