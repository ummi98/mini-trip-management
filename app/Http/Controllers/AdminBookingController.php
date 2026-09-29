<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminBookingController extends Controller
{
    public function index(Request $request): View
    {
        $bookings = Booking::query()
            ->with(['user', 'trip', 'participants'])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('booking_no', 'like', "%{$search}%")
                        ->orWhereHas(
                            'user',
                            fn ($query) =>
                                $query->where(
                                    'name',
                                    'like',
                                    "%{$search}%"
                                )
                        )
                        ->orWhereHas(
                            'trip',
                            fn ($query) =>
                                $query->where(
                                    'title',
                                    'like',
                                    "%{$search}%"
                                )
                        );
                });
            })
            ->when(
                $request->status,
                fn ($query, $status) =>
                    $query->where('status', $status)
            )
            ->when(
                $request->payment_status,
                fn ($query, $status) =>
                    $query->where('payment_status', $status)
            )
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view(
            'admin.bookings.index',
            compact('bookings')
        );
    }

    public function show(Booking $booking): View
    {
        $booking->load([
            'user',
            'trip',
            'participants',
        ]);

        return view(
            'admin.bookings.show',
            compact('booking')
        );
    }

    public function update(Request $request, Booking $booking)
        : RedirectResponse
    {
        $data = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'confirmed',
                    'cancelled',
                ]),
            ],

            'payment_status' => [
                'required',
                Rule::in([
                    'unpaid',
                    'paid',
                ]),
            ],
        ]);

        $booking->update($data);

        return back()->with(
            'success',
            'Booking status updated successfully.'
        );
    }
}