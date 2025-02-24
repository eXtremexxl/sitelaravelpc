<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Component;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function products()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function createProduct()
    {
        $components = Component::all()->groupBy('category'); // Группируем комплектующие по категориям
        return view('admin.create_product', compact('components'));
    }

    public function storeProduct(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'components' => 'required|array|min:1', // ✅ Комплектующие обязательны
        ], [
            'components.required' => 'Выберите хотя бы одно комплектующее!', // ✅ Кастомное сообщение
            'components.min' => 'Выберите хотя бы одно комплектующее!', // ✅ Дополнительная защита
        ]);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }
    
        $product = Product::create($data);
        $product->components()->sync($data['components']);
    
        return redirect()->route('admin.products')->with('success', 'Товар добавлен');
    }
    

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $components = Component::all()->groupBy('category'); // Группируем комплектующие
        return view('admin.edit_product', compact('product', 'components'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'components' => 'nullable|array', // Массив ID комплектующих
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }

        $product->update($data);
        $product->components()->sync($request->components ?? []);

        return redirect()->route('admin.products')->with('success', 'Товар обновлён');
    }

    public function deleteProduct($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.products')->with('success', 'Товар удалён');
    }

    public function orders()
    {
        $orders = Order::with(['items.product', 'user'])->get(); // ✅ Загружаем товары и пользователя
        return view('admin.orders', compact('orders'));
    }
    
    

    public function updateOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders')->with('success', 'Статус обновлён');
    }
}
