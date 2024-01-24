<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bookings = Auth::user()->bookings()->with('car')->get();
        return view('bookings.list_booking', compact('bookings'));
    }

    public function create()
    {
        $cars = Car::where('availability', true)->get();
        return view('bookings.create_booking', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:start_date',
        ]);

        $car = Car::findOrFail($request->car_id);

        // Convert start_date and return_date to Carbon instances
        $startDate = Carbon::parse($request->start_date);
        $returnDate = Carbon::parse($request->return_date);

        // Calculate totalCost
        $daysRented = $startDate->diffInDays($returnDate);
        $totalCost = $car->rental_rate_per_day * $daysRented;

        // Create the booking
        $booking = Auth::user()->bookings()->create([
            'car_id' => $request->car_id,
            'start_date' => $startDate,
            'return_date' => $returnDate,
            'total_cost' => $totalCost,
        ]);

        // Update car availability
        $car->update(['availability' => false]);

        return redirect()->route('bookings.list_booking')->with('success', 'Booking created successfully!');
    }
}
