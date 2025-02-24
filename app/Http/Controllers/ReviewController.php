<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Метод сохранения отзыва (если его еще нет)
    public function store(Request $request, $productId)
    {
        // Проверяем, оставлял ли пользователь уже отзыв
        $existingReview = Review::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($existingReview) {
            return redirect()->route('product.show', $productId)
                ->with('error', 'Вы уже оставили отзыв на этот товар. Вы можете его только редактировать.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('product.show', $productId)->with('success', 'Отзыв добавлен!');
    }

    // Метод редактирования отзыва
    public function edit($reviewId)
    {
        $review = Review::where('id', $reviewId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('edit_review', compact('review'));
    }

    // Метод обновления отзыва (добавление дополнения)
    public function update(Request $request, $reviewId)
    {
        $review = Review::where('id', $reviewId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'additional_comment' => 'required|string',
        ]);

        // Добавляем дополнение к отзыву
        $review->comment .= "\n\n📝 **Дополнение:** " . $request->additional_comment;
        $review->rating = $request->rating;
        $review->updated_at = now();
        $review->save();

        return redirect()->route('product.show', $review->product_id)->with('success', 'Ваш отзыв обновлён!');
    }
}
