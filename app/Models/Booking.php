<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Car;


class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'car_id', 
        'start_date', 
        'return_date', 
        'total_cost'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }
}
