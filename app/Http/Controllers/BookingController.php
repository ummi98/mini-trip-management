<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(): View
    {
        $bookings = Booking::query()
            ->where('user_id', auth()->id())
            ->with(['trip', 'participants'])
            ->latest()
            ->paginate(10);

        return view(
            'customer.bookings.index',
            compact('bookings')
        );
    }

    public function store(Trip $trip): RedirectResponse
    {
        if ($trip->status !== 'available') {
            return back()->with(
                'error',
                'This trip is not available for booking.'
            );
        }

        $booking = DB::transaction(function () use ($trip) {
            $lockedTrip = Trip::query()
                ->lockForUpdate()
                ->findOrFail($trip->id);

            $participantCount = $lockedTrip
                ->participants()
                ->count();

            if ($participantCount >= $lockedTrip->max_capacity) {
                return null;
            }

            return Booking::create([
                'booking_no' => $this->generateBookingNo(),
                'user_id' => auth()->id(),
                'trip_id' => $lockedTrip->id,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'total_amount' => 0,
            ]);
        });

        if (! $booking) {
            return back()->with(
                'error',
                'Sorry, this trip is already full.'
            );
        }

        return redirect()
            ->route('customer.bookings.show', $booking)
            ->with(
                'success',
                'Booking created. Please register your participant.'
            );
    }

    public function show(Booking $booking): View
    {
        $this->ensureOwner($booking);

        $booking->load(['trip', 'participants']);

        return view(
            'customer.bookings.show',
            compact('booking')
        );
    }

    private function ensureOwner(Booking $booking): void
    {
        abort_unless(
            $booking->user_id === auth()->id(),
            403
        );
    }

    private function generateBookingNo(): string
    {
        do {
            $bookingNo = 'BK-' .
                now()->format('Ymd') .
                '-' .
                Str::upper(Str::random(6));
        } while (
            Booking::where('booking_no', $bookingNo)->exists()
        );

        return $bookingNo;
    }
}