<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerTripController extends Controller
{
    public function index(Request $request): View
    {
        $trips = Trip::query()
            ->where('status', 'available')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('destination', 'like', "%{$search}%");
                });
            })
            ->orderBy('start_date')
            ->paginate(9)
            ->withQueryString();

        return view('customer.trips.index', compact('trips'));
    }

    public function show(Trip $trip): View
    {
        abort_unless($trip->status === 'available', 404);

        $participantCount = $trip->participants()->count();

        $remainingSeats = max(
            0,
            $trip->max_capacity - $participantCount
        );

        return view(
            'customer.trips.show',
            compact('trip', 'participantCount', 'remainingSeats')
        );
    }
}