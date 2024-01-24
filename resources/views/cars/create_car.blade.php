@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Data Mobil</h2>
        <form method="POST" action="{{ route('cars.store') }}">
            @csrf
            <div class="mb-3">
                <label for="brand" class="form-label">Merek</label>
                <input type="text" class="form-control" id="brand" name="brand" required>
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" id="model" name="model" required>
            </div>
            <div class="mb-3">
                <label for="plate_number" class="form-label">Nomor Plat</label>
                <input type="text" class="form-control" id="plate_number" name="plate_number" required>
            </div>
            <div class="mb-3">
                <label for="rental_rate_per_day" class="form-label">Tarif Sewa per Hari</label>
                <input type="text" class="form-control" id="rental_rate_per_day" name="rental_rate_per_day" required>
            </div>
            <div class="mb-3">
                <label for="availability" class="form-label">Ketersediaan</label>
                <select class="form-select" id="availability" name="availability" required>
                    <option value="1">Tersedia</option>
                    <option value="0">Tidak Tersedia</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>

            <!-- Tombol Kembali -->
            <a href="{{ URL::previous() }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
