<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'model',
        'capacity',
        'seating_capacity',
        'luggage_capacity',
        'description',
        'features',
        'has_ac',
        'price_per_km',
        'price_per_day',
        'image',
        'gallery',
        'is_luxury',
        'is_available',
        'is_active',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_canonical',
    ];

    protected $casts = [
        'gallery' => 'array',
        'price_per_km' => 'decimal:2',
        'price_per_day' => 'decimal:2',
        'has_ac' => 'boolean',
        'is_luxury' => 'boolean',
        'is_available' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
