<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model {
    use HasFactory;

    protected $fillable = ['user_id', 'components', 'name'];

    protected $casts = [
        'components' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}