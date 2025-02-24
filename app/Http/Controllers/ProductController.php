<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Component;

class ProductController extends Controller {
    // Каталог товаров с фильтрацией
    public function index(Request $request) {
        $query = Product::query();
    
        // Фильтрация по комплектующим
        if ($request->has('components')) {
            $selectedComponents = $request->input('components');
    
            $query->whereHas('components', function ($q) use ($selectedComponents) {
                $q->whereIn('components.id', $selectedComponents); // Указываем таблицу явно
            });
        }
    
        $products = $query->select('products.*')->get(); // Явно указываем, что берем поля из `products`
        $components = Component::all()->groupBy('category');
    
        return view('catalog', compact('products', 'components'));
    }
    
    
    

    // Страница товара
    public function show($id) {
        $product = Product::findOrFail($id);
        return view('product', compact('product'));
    }
}
