<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'discount_price', 'image'];

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function averageRating() {
        return $this->reviews()->avg('rating') ?? 0;
    }
    
    public function components() {
        return $this->belongsToMany(Component::class, 'component_product');
    }


    
}
