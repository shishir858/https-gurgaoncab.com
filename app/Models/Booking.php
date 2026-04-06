<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'vehicle_id',
        'booking_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'total_people',
        'booking_date',
        'travel_date',
        'total_amount',
        'paid_amount',
        'payment_status',
        'booking_status',
        'special_requests',
        'admin_notes',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'travel_date' => 'date',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
