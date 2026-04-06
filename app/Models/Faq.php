<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'location_id',
        'question',
        'answer',
        'is_active',
        'order',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
