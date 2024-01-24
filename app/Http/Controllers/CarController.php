<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('cars.list_car', compact('cars'));
    }

    public function create()
    {
        return view('cars.create_car');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'plate_number' => 'required|string',
            'rental_rate_per_day' => 'required|numeric',
            'availability' => 'required|boolean',
        ]);

        Car::create($request->all());

        return redirect()->route('cars.list_car')->with('success', 'Car added successfully!');
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        return view('cars.edit_car', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'plate_number' => 'required|string',
            'rental_rate_per_day' => 'required|numeric',
            'availability' => 'required|boolean',
        ]);

        $car = Car::findOrFail($id);
        $car->update($request->all());

        return redirect()->route('cars.list_car')->with('success', 'Car updated successfully!');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('cars.list_car')->with('success', 'Car deleted successfully!');
    }
}
