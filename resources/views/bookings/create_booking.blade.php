@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Book a Car</h2>
        <form method="POST" action="{{ route('bookings.store') }}">
            @csrf
            <div class="mb-3">
                <label for="car_id" class="form-label">Select Car</label>
                <select class="form-select" id="car_id" name="car_id" required>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}">{{ $car->brand }} {{ $car->model }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="mb-3">
                <label for="return_date" class="form-label">Return Date</label>
                <input type="date" class="form-control" id="return_date" name="return_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Book Now</button>
                        <a href="{{ URL::previous() }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
