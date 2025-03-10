<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model {
    use HasFactory;

    protected $fillable = [
        'name', 'category', 'socket', 'power', 'capacity', 'price', 'image',
        'form_factor', 'memory_slots', 'max_memory_freq', 'pcie_version',
        'max_gpu_length', 'max_psu_length', 'tdp', 'frequency', 'benchmark_score'
    ];

    public function products() {
        return $this->belongsToMany(Product::class, 'component_product');
    }

    public static function getGroupedComponents() {
        return self::all()->groupBy('category');
    }
}