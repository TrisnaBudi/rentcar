<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnCar extends Model
{
    use HasFactory;

    protected $table = 'returns';
    protected $fillable = [
        'plate_number',
        'return_date',
        'days_rented',
        'rental_cost',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'plate_number', 'plate_number');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
