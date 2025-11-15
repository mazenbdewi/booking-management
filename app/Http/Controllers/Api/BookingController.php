<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Booking::with(['service', 'creator']);

        if ($user->role === 'staff') {
            $query->where('created_by', $user->id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('date')) {
            $query->whereDate('booking_date', $request->date);
        }

        $bookings = $query->orderBy('booking_date', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'success get data',
            'data' => BookingResource::collection($bookings),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'phone_number' => 'required|string|max:20',
            'booking_date' => 'required|date',
            'service_id' => 'required|exists:services,id',
            'notes' => 'nullable|string',
        ]);

        $validated['created_by'] = auth()->id();

        $booking = Booking::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Booking created successfully',
            'booking' => $booking,
        ]);
    }
}
