<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request) {
        
        $status = $request->query('status'); // optional filter

        $bookings = Booking::query()
                ->with(['user', 'service']) // avoids N+1 queries
                ->when($status, fn ($q) => $q->where('status', $status))
                ->orderByDesc('booking_date')
                ->orderByDesc('booking_time')
                ->paginate(15)
                ->withQueryString();

        return view('admin.bookings.index', compact('bookings', 'status'));
    }


    public function updateStatus(Request $request, Booking $booking) {
        // Oly allow specific statuses
        $request->validate([
            'status' => ['required', 'in:pending,approved,rejected,completed'],
        ]);

        // Editor can update, but let's restrict delete/complete later if you want
        $booking->status = $request->input('status');
        $booking->save();

        return back()->with('status', 'Booking status updated.');
    }
}
