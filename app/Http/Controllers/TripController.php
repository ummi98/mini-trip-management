<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TripController extends Controller
{
    public function index(Request $request): View
    {
        $trips = Trip::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('destination', 'like', "%{$search}%");
                });
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('trips.index', compact('trips'));
    }

    public function create(): View
    {
        return view('trips.create');
    }

    public function store(StoreTripRequest $request): RedirectResponse
    {
        Trip::create($request->validated());

        return redirect()
            ->route('trips.index')
            ->with('success', 'Trip created successfully.');
    }

    public function show(Trip $trip): View
    {
        return view('trips.show', compact('trip'));
    }

    public function edit(Trip $trip): View
    {
        return view('trips.edit', compact('trip'));
    }

    public function update(
        UpdateTripRequest $request,
        Trip $trip
    ): RedirectResponse {
        $trip->update($request->validated());

        return redirect()
            ->route('trips.index')
            ->with('success', 'Trip updated successfully.');
    }

    public function destroy(Trip $trip): RedirectResponse
    {
        $trip->delete();

        return redirect()
            ->route('trips.index')
            ->with('success', 'Trip deleted successfully.');
    }
}