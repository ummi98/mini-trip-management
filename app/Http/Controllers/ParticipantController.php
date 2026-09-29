<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipantRequest;
use App\Models\Booking;
use App\Models\Participant;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ParticipantController extends Controller
{
    public function create(Booking $booking): View
    {
        $this->ensureOwner($booking);

        $booking->load('trip');

        return view(
            'customer.participants.create',
            compact('booking')
        );
    }

    public function store(
        StoreParticipantRequest $request,
        Booking $booking
    ): RedirectResponse {
        $this->ensureOwner($booking);

        if ($booking->status === 'cancelled') {
            return back()->with(
                'error',
                'Participants cannot be added to a cancelled booking.'
            );
        }

        $data = $request->validated();

        $participant = DB::transaction(
            function () use ($booking, $request, $data) {
                $trip = Trip::query()
                    ->lockForUpdate()
                    ->findOrFail($booking->trip_id);

                $participantCount = $trip
                    ->participants()
                    ->count();

                if ($participantCount >= $trip->max_capacity) {
                    return null;
                }

                $duplicate = Participant::query()
                    ->where('booking_id', $booking->id)
                    ->where(
                        'passport_no',
                        $data['passport_no']
                    )
                    ->exists();

                if ($duplicate) {
                    throw ValidationException::withMessages([
                        'passport_no' =>
                            'This participant is already registered.',
                    ]);
                }

                if ($request->hasFile('passport_file')) {
                    $data['passport_file'] = $request
                        ->file('passport_file')
                        ->store('passports', 'public');
                }

                $data['booking_id'] = $booking->id;

                $participant = Participant::create($data);

                $booking->update([
                    'total_amount' =>
                        $booking->participants()->count()
                        * $trip->price,
                ]);

                return $participant;
            }
        );

        if (! $participant) {
            return back()->with(
                'error',
                'Trip is full. No remaining seats are available.'
            );
        }

        return redirect()
            ->route('customer.bookings.show', $booking)
            ->with(
                'success',
                'Participant registered successfully.'
            );
    }

    private function ensureOwner(Booking $booking): void
    {
        abort_unless(
            $booking->user_id === auth()->id(),
            403
        );
    }
}