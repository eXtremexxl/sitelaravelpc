<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Загружаем популярные продукты по рейтингу (оставляем твой код)
        $popularProducts = Product::with('reviews')
            ->get()
            ->sortByDesc(fn($product) => $product->averageRating())
            ->take(3);
        
        // Загружаем все продукты для слайдера
        $products = Product::all();

        return view('home', compact('popularProducts', 'products'));
    }
}

