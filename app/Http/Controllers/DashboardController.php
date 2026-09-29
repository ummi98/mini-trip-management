<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Participant;
use App\Models\Trip;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        if ($user->role === 'customer') {
            return view('dashboard', [
                'tripCount' => Trip::where(
                    'status',
                    'available'
                )->count(),

                'bookingCount' => Booking::where(
                    'user_id',
                    $user->id
                )->count(),

                'pendingCount' => Booking::where(
                    'user_id',
                    $user->id
                )
                    ->where('status', 'pending')
                    ->count(),
            ]);
        }

        return view('dashboard', [
            'tripCount' => Trip::count(),
            'bookingCount' => Booking::count(),
            'pendingCount' => Booking::where(
                'status',
                'pending'
            )->count(),
            'participantCount' => Participant::count(),
        ]);
    }
}