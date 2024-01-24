@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Record Return</h2>
        <form method="POST" action="{{ route('returns.store') }}">
            @csrf
            <div class="mb-3">
                <label for="plate_number" class="form-label">Select Car</label>
                <select class="form-select" id="plate_number" name="plate_number" required>
                    @foreach($bookings as $booking)
                        <option value="{{ $booking->car->plate_number }}">{{ $booking->car->plate_number }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="return_date" class="form-label">Return Date</label>
                <input type="date" class="form-control" id="return_date" name="return_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Record Return</button>
        </form>
    </div>
@endsection
