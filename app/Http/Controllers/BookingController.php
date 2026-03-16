<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create() {
        $services = Service::query()
            ->where('active', true)
            ->orderBy('name')
            ->get();

        return view('bookings.create', compact('services'));
    }

    public function store(StoreBookingRequest $request) {
        $data = $request->validated();

        try {
            Booking::create([
                'user_id' => $request->user()->id,
                'service_id' => $data['service_id'],
                'booking_date' => $data['booking_date'],
                'booking_time' => $data['booking_time'],
                'status' => 'pending',
                'notes' => $data['notes'] ?? null,
            ]);
        } catch (QueryException $e) {
            // if unique constraint hits,  show friendly error
            return back()
                ->withInput()
                ->withErrors(['booking_time' => 'This time slot is already booked. Please choose another time.']);
        }

        return redirect()->route('bookings.create')->with('status', 'Booking submitted! (Pending approval');
    }
}
