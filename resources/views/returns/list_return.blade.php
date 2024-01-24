@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>List of Returns</h2>
        <a href="{{ route('returns.create_return') }}" class="btn btn-primary">Return the Car</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Return Date</th>
                    <th>Days Rented</th>
                    <th>Rental Cost</th>
                </tr>
            </thead>
            <tbody>
                @forelse($returns as $return)
                    <tr>
                        <td>{{ $return->booking_id }}</td>
                        <td>{{ $return->return_date }}</td>
                        <td>{{ $return->days_rented }}</td>
                        <td>${{ $return->rental_cost }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No returns recorded yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
