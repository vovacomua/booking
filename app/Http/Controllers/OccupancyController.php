<?php

namespace App\Http\Controllers;

use App\Http\Requests\OccupancyRatesRequest;
use App\Models\Block;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        //set SQL DATE format
        $date = \DateTime::createFromFormat('Y-m-d', $date);
        $date = $date->format('Y-m-d');

        return response()->json([
            'occupancy_rate' => $this->occupancyService->occupancyRate($date)
        ]);
    }

    /**
     * Get monthly occupancy.
     */
    public function monthly(OccupancyRatesRequest $request)
    {
        //
    }
}
