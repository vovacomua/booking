<?php

namespace App\Services;

use App\Models\Block;
use App\Models\Booking;
use App\Models\Room;

class OccupancyService
{
    public function occupancyRate($date): float
    {
        $countOccupancy = Booking::where('starts_at', '<=', $date)
            ->where('ends_at', '>=', $date)
            ->count();

        $totalCapacity = Room::sum('capacity');

        $countBlocks = Block::where('starts_at', '<=', $date)
            ->where('ends_at', '>=', $date)
            ->count();
        //TODO when + whereIn could have been used to count occupancy rate for an array of rooms

        return $countOccupancy / ($totalCapacity - $countBlocks);
    }
}
