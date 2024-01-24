@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Data Mobil</h2>
        <form method="POST" action="{{ route('cars.update', $car->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="brand" class="form-label">Merek</label>
                <input type="text" class="form-control" id="brand" name="brand" value="{{ $car->brand }}" required>
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" id="model" name="model" value="{{ $car->model }}" required>
            </div>
            <div class="mb-3">
                <label for="plate_number" class="form-label">Nomor Plat</label>
                <input type="text" class="form-control" id="plate_number" name="plate_number" value="{{ $car->plate_number }}" required>
            </div>
            <div class="mb-3">
                <label for="rental_rate_per_day" class="form-label">Tarif Sewa per Hari</label>
                <input type="text" class="form-control" id="rental_rate_per_day" name="rental_rate_per_day" value="{{ $car->rental_rate_per_day }}" required>
            </div>
            <div class="mb-3">
                <label for="availability" class="form-label">Ketersediaan</label>
                <select class="form-select" id="availability" name="availability" required>
                    <option value="1" {{ $car->availability ? 'selected' : '' }}>Tersedia</option>
                    <option value="0" {{ !$car->availability ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>

            <!-- Tombol Kembali -->
            <a href="{{ URL::previous() }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
