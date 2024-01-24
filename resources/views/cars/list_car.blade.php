<!-- resources/views/cars/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>List of Cars</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('cars.create_car') }}" class="btn btn-success">Add Car</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Plate Number</th>
                    <th>Rental Rate/Day</th>
                    <th>Availability</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->plate_number }}</td>
                        <td>{{ $car->rental_rate_per_day }}</td>
                        <td>{{ $car->availability ? 'Available' : 'Not Available' }}</td>
                        <td>
                            <a href="{{ route('cars.edit_car', $car->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this car?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No cars available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
