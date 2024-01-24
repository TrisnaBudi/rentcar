<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReturnController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.register');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Route untuk Mobil
    Route::get('/cars', [CarController::class, 'index'])->name('cars.list_car');
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create_car');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit_car');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');

    // Route untuk Pemesanan
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.list_booking');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create_booking');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    
    // Route untuk Pengembalian
    Route::get('/returns', [ReturnController::class, 'index'])->name('returns.list_return');
    Route::get('/returns/create', [ReturnController::class, 'create'])->name('returns.create_return');
    Route::post('/returns', [ReturnController::class, 'store'])->name('returns.store');

    // Route untuk logout
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});