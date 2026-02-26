<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Facility;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Facility $facility)
    {
        return view('bookings.create', compact('facility'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'start_time'  => 'required|date|after:now',
            'end_time'    => 'required|date|after:start_time',
        ]);

        // Double booking check
        $overlap = Booking::where('facility_id', $validated['facility_id'])
            ->where('status', 'approved')
            ->where('start_time', '<', $validated['end_time'])
            ->where('end_time', '>', $validated['start_time'])
            ->exists();

        if ($overlap) {
            return back()->withErrors([
                'start_time' => 'This facility is already booked for the selected time slot.',
            ])->withInput();
        }

        Booking::create([
            'user_id'     => auth()->id(),
            'facility_id' => $validated['facility_id'],
            'start_time'  => $validated['start_time'],
            'end_time'    => $validated['end_time'],
            'status'      => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking submitted and pending approval.');
    }

    public function cancel(Booking $booking)
    {
        // Users can only cancel their own pending bookings
        if ($booking->user_id !== auth()->id() || $booking->status !== 'pending') {
            abort(403);
        }

        $booking->delete();

        return back()->with('success', 'Booking cancelled.');
    }

    public function approve(Booking $booking)
    {
        // Re-check for overlaps before approving
        $overlap = Booking::where('facility_id', $booking->facility_id)
            ->where('status', 'approved')
            ->where('id', '!=', $booking->id)
            ->where('start_time', '<', $booking->end_time)
            ->where('end_time', '>', $booking->start_time)
            ->exists();

        if ($overlap) {
            return back()->withErrors(['error' => 'Cannot approve: overlapping booking exists.']);
        }

        $booking->update(['status' => 'approved']);

        return back()->with('success', 'Booking approved.');
    }

    public function reject(Booking $booking)
    {
        $booking->update(['status' => 'rejected']);

        return back()->with('success', 'Booking rejected.');
    }
}
