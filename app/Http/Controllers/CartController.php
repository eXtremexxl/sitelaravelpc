<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {
    // Просмотр корзины
    public function index() {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('cart', compact('cartItems'));
    }

    // Добавление в корзину
    public function add($id) {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Войдите в аккаунт, чтобы добавить в корзину');
        }

        $product = Product::findOrFail($id);

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        return redirect()->route('cart')->with('success', 'Товар добавлен в корзину');
    }

    // Удаление из корзины
    public function remove($id) {
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $id)
                        ->first();
    
        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity'); // Уменьшаем количество на 1
            } else {
                $cartItem->delete(); // Если остался один, удаляем полностью
            }
        }
    
        return redirect()->route('cart')->with('success', 'Товар удалён из корзины');
    }
    
}
