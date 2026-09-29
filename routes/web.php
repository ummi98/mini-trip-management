<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TripController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerTripController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\AdminBookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::resource('trips', TripController::class);
    Route::get(
        '/bookings',
        [AdminBookingController::class, 'index']
    )->name('admin.bookings.index');
    
    Route::get(
        '/bookings/{booking}',
        [AdminBookingController::class, 'show']
    )->name('admin.bookings.show');
    
    Route::patch(
        '/bookings/{booking}',
        [AdminBookingController::class, 'update']
    )->name('admin.bookings.update');
});

Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        Route::get(
            '/trips',
            [CustomerTripController::class, 'index']
        )->name('trips.index');

        Route::get(
            '/trips/{trip}',
            [CustomerTripController::class, 'show']
        )->name('trips.show');

        Route::post(
            '/trips/{trip}/book',
            [BookingController::class, 'store']
        )->name('bookings.store');

        Route::get(
            '/bookings',
            [BookingController::class, 'index']
        )->name('bookings.index');

        Route::get(
            '/bookings/{booking}',
            [BookingController::class, 'show']
        )->name('bookings.show');

        Route::get(
            '/bookings/{booking}/participants/create',
            [ParticipantController::class, 'create']
        )->name('participants.create');

        Route::post(
            '/bookings/{booking}/participants',
            [ParticipantController::class, 'store']
        )->name('participants.store');
    });

require __DIR__.'/auth.php';
