@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>My Bookings</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('bookings.create_booking') }}" class="btn btn-primary">Car Booking</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Car</th>
                    <th>Plate Number</th>
                    <th>Start Date</th>
                    <th>Return Date</th>
                    <th>Total Cost</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <td>{{ $booking->car->brand }} {{ $booking->car->model }}</td>
                        <td>{{ $booking->car->plate_number }}</td>
                        <td>{{ $booking->start_date }}</td>
                        <td>{{ $booking->return_date }}</td>
                        <td>Rp.{{ $booking->total_cost }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No bookings yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
