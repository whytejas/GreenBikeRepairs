<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepairShop;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings    =  Booking::all();
        //  $bookings =  Auth::user()->bookings();
        dd($bookings);
        return response()->json($shops, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'repair_shop_id' => 'required|exists:repair_shops,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        } else {
            if (Auth::check()) {
                $user = Auth::user();
                $repairShop = RepairShop::findOrFail($request->repair_shop_id);

                if ($repairShop) {
                    // Check if user already has a booking today
                    if ($user->bookings()->whereDate('booking_date', today())->exists()) {
                        return response()->json(['message' => 'You already have a booking for today.'], 400);
                    } else {
                        // Check if repair shop still has slots
                        if ($repairShop->remainingSlots() <= 0) {
                            return response()->json(['message' => 'No more slots available.'], 400);
                        } else {
                            // Create a new booking
                            $booking = Booking::create([
                                'user_id' => $user->id,
                                'repair_shop_id' => $repairShop->id,
                                'booking_date' => today(),
                            ]);
                            if ($booking) {
                                return response()->json(['message' => 'Booking created successfully', 'booking' => $booking], 201);
                            } else {
                                return response()->json(['error' => 'Failed to create booking'], 500);
                            }
                        }
                    }
                } else {
                    return response()->json(['error' => ('User not found')], 404);
                }
            } else {
                return response()->json(['error' => ('User not found')], 404);
            }
        }
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
    public function destroy()
    {
        $user = Auth::user();
        $existing_booking = $user->bookings()->whereDate('booking_date', today())->first();
        if ($existing_booking) {
            $existing_booking->delete();
            return response()->json(['error' => ('booking deleted')], 200);
        } else {
            return response()->json(['error' => ('booking not found')], 404);
        }
    }
}
