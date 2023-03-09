<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\BookingUpdateRequest;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingStoreRequest $request)
    {
        //too tiny to create service
        $booking = Booking::create($request->validated());
        return response()->json($booking);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookingUpdateRequest $request, Booking $booking)
    {
        $booking = $booking->update($request->validated());
        return response()->json($booking);
    }

}
