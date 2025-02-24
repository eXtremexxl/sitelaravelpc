<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model {
    use HasFactory;

    protected $fillable = ['name', 'category'];

    public function products() {
        return $this->belongsToMany(Product::class, 'component_product');
    }

    public static function getGroupedComponents() {
        return self::all()->groupBy('category');
    }
}
