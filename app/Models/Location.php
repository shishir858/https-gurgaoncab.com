<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'meta_canonical',
        'image',
        'content',
        'is_active',
    ];

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }
}
