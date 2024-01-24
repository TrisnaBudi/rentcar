<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Booking;
use App\Models\ReturnCar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
    try {
        $request->validate([
            'plate_number' => 'required|exists:cars,plate_number',
            'return_date' => 'required|date',
        ]);

        Log::info('Validation passed');

        $car = Car::where('plate_number', $request->plate_number)->first();

        if (!$car) {
            Log::error('Car not found');
            return redirect()->back()->with('error', 'Car with plate number ' . $request->plate_number . ' not found.');
        }

        Log::info('Car found: ' . json_encode(['car' => $car]));

        $booking = $car->bookings()
                ->whereDate('start_date', '<=', $request->return_date)
                ->whereDate('return_date', '>=', $request->return_date)
                ->first();

        Log::info('Booking found: ' . json_encode(['booking' => $booking]));

        if (!$booking) {
            Log::error('Car not currently rented');
            return redirect()->back()->with('error', 'Car with plate number ' . $request->plate_number . ' not currently rented.');
        }


        $daysRented = Carbon::parse($booking->start_date)->diffInDays($request->return_date);
        $rentalCost = $car->rental_rate_per_day * $daysRented;

        Log::info('Creating ReturnCar record');

        $return = ReturnCar::create([
            'plate_number' => $request->plate_number,
            'return_date' => $request->return_date,
            'days_rented' => $daysRented,
            'rental_cost' => $rentalCost,
        ]);

        Log::info('Updating booking and car records');

        $booking->update(['return_date' => $request->return_date]);
        $car->update(['availability' => true]);

        Log::info('Redirecting with success message');

        return redirect()->route('returns.list_return')->with('success', 'Return recorded successfully!');
    } catch (\Exception $exception) {
        Log::error('Error: ' . $exception->getMessage());
        return redirect()->back()->with('error', 'Error: ' . $exception->getMessage());
    }
}


}
