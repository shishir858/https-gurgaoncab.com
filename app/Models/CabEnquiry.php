<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CabEnquiry extends Model
{
    protected $fillable = [
        'name',
        'passenger',
        'pickup_location',
        'drop_location',
        'vehicle_type',
        'phone',
        'date',
        'pickup_time',
        'email',
        'message',
        'status'
    ];
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
