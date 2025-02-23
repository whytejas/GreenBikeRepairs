<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepairShop;
use App\Models\Booking;
use App\Models\User;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'repair_shop_id' => 'required|exists:repair_shops,id',
        ]);

        $user = auth()->user();
        $repairShop = RepairShop::findOrFail($request->repair_shop_id);

        // Check if user already has a booking today
        if ($user->bookings()->whereDate('booking_date', today())->exists()) {
            return response()->json(['message' => 'You already have a booking for today.'], 400);
        }

        // Check if repair shop still has slots
        if ($repairShop->remainingSlots() <= 0) {
            return response()->json(['message' => 'No more slots available.'], 400);
        }

        // Create a new booking
        $booking = Booking::create([
            'user_id' => $user->id,
            'repair_shop_id' => $repairShop->id,
            'booking_date' => today(),
        ]);

        return response()->json($booking, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
