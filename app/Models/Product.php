<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'rating',
        'price',
        'description',
        'main_ingredients',
        'how_to_use',
        'stock',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
