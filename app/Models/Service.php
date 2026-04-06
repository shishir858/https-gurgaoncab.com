<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title', 'slug', 'feature_image', 'duration', 'amenities', 'highlights', 'itinerary', 'included', 'excluded', 'more_contents', 'description', 'is_active', 'meta_title', 'meta_description', 'meta_keywords', 'meta_canonical', 'offer'
    ];
}
