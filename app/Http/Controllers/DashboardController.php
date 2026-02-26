<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $status   = $request->query('status');
            $bookings = Booking::with(['user', 'facility'])
                ->when($status, fn($q) => $q->where('status', $status))
                ->latest()
                ->paginate(15);

            return view('dashboard.admin', compact('bookings', 'status'));
        }

        $bookings = Booking::with('facility')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(15);

        return view('dashboard.user', compact('bookings'));
    }
}
