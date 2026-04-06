<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'from_location',
        'to_location',
        'distance',
        'duration',
        'description',
        'highlights',
        'base_price',
        'image',
        'is_popular',
        'is_active',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_canonical',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'is_popular' => 'boolean',
        'is_active' => 'boolean',
    ];
}
