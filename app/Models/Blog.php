<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_canonical',
        'feature_image',
        'content',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
