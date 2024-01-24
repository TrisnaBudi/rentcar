<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Booking;
use App\Models\ReturnCar;

class ReturnController extends Controller
{
    public function index()
    {
        $returns = ReturnCar::all();
        return view('returns.list_return', compact('returns'));
    }

    public function create()
    {
        $bookings = Booking::whereNotNull('return_date')->get();
        return view('returns.create_return', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate_number' => 'required|exists:cars,plate_number',
            'return_date' => 'required|date',
        ]);

        $car = Car::where('plate_number', $request->plate_number)->first();
        $booking = $car->bookings()->whereNull('return_date')->first();

        if (!$booking) {
            return redirect()->back()->with('error', 'Car with plate number ' . $request->plate_number . ' not currently rented.');
        }

        $daysRented = $booking->start_date->diffInDays($request->return_date);
        $rentalCost = $car->rental_rate_per_day * $daysRented;

        $return = ReturnCar::create([
            'plate_number' => $request->plate_number,
            'return_date' => $request->return_date,
            'days_rented' => $daysRented,
            'rental_cost' => $rentalCost,
        ]);

        $booking->update(['return_date' => $request->return_date]);
        $car->update(['availability' => true]);

        return redirect()->route('returns.list_return')->with('success', 'Return recorded successfully!');
    }
}
