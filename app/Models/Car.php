<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'plate_number',
        'rental_rate_per_day',
        'availability',
    ];

        public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

