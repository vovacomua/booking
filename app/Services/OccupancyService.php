<?php

namespace App\Services;

use App\Models\Block;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OccupancyService
{
    public function occupancyRateDaily($date, $roomIds): float
    {
        $roomIds = $this->getRoomIds($roomIds);

        $countOccupancy = Booking::query()
            ->whereIn('room_id', $roomIds)
            ->whereDate('starts_at', '<=', $date)
            ->whereDate('ends_at', '>=', $date)
            ->count();

        $totalCapacity = Room::query()
            ->whereIn('id', $roomIds)
            ->sum('capacity');

        $countBlocks = Block::query()
            ->whereDate('starts_at', '<=', $date)
            ->whereDate('ends_at', '>=', $date)
            ->count();

        $occupancyRate = $countOccupancy / ($totalCapacity - $countBlocks);
        return round($occupancyRate, 2);
    }

    public function occupancyRateMonthly($date, $roomIds): float
    {
        $roomIds = $this->getRoomIds($roomIds);

        $date = Carbon::createFromFormat('Y-m', $date);
        $daysInMonth = $date->daysInMonth;
        $startDate = $date->startOfMonth()->format('Y-m-d');
        $endDate = $date->endOfMonth()->format('Y-m-d');

        $countOccupancy = Booking::query()
            ->select(DB::raw('COALESCE(IFNULL(SUM(DATEDIFF(ends_at, starts_at) + 1), 0), 0) AS total_duration'))
            ->whereIn('room_id', $roomIds)
            ->where('starts_at', '>=', $startDate)
            ->where('ends_at', '<=', $endDate)
            ->first()
            ->total_duration;

        $totalCapacity = Room::query()
            ->whereIn('id', $roomIds)
            ->sum('capacity');

        $countBlocks = Block::query()
            ->select(DB::raw('COALESCE(IFNULL(SUM(DATEDIFF(ends_at, starts_at) + 1), 0), 0) AS total_duration'))
            ->whereIn('room_id', $roomIds)
            ->where('starts_at', '>=', $startDate)
            ->where('ends_at', '<=', $endDate)
            ->first()
            ->total_duration;

        $occupancyRate = $countOccupancy / (($totalCapacity * $daysInMonth) - $countBlocks);
        return round($occupancyRate, 2);
    }

    private function getRoomIds($roomIds) : array
    {
        if (!$roomIds) {
            $roomIds = Room::all()->pluck('id')->toArray();
        }
        return $roomIds;
    }
}
