<?php

namespace App\Http\Controllers;

use App\Http\Requests\OccupancyRatesRequest;
use Illuminate\Support\Facades\Validator;
use App\Services\OccupancyService;

class OccupancyController extends Controller
{
    private OccupancyService $occupancyService;

    public function __construct(OccupancyService $occupancyService)
    {
        $this->occupancyService = $occupancyService;
    }

    /**
     * Get daily occupancy.
     */
    public function daily(OccupancyRatesRequest $request, $date)
    {
        $validator = Validator::make(['date' => $date], [
            'date' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid date format.'], 422);
        }

        return response()->json([
            'occupancy_rate' => $this->occupancyService->occupancyRateDaily(
                $date,
                $request->input('room_ids', null)
            )
        ]);
    }

    /**
     * Get monthly occupancy.
     */
    public function monthly(OccupancyRatesRequest $request,  $date)
    {
        $validator = Validator::make(['date' => $date], [
            'date' => 'required|date_format:Y-m',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid date format.'], 422);
        }

        return response()->json([
            'occupancy_rate' => $this->occupancyService->occupancyRateMonthly(
                $date,
                $request->input('room_ids', null)
            )
        ]);
    }
}
