<?php

namespace Tests\Unit;

use App\Services\OccupancyService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OccupancyServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function test_occupancy_rate_daily(): void
    {
        $this->seed();
        $service = new OccupancyService();
        $rate = $service->occupancyRateDaily('2023-01-02', [2,3]);

        // Assert that the occupancy rate is calculated correctly
        $this->assertEquals(0.2, $rate);
    }

    public function test_occupancy_rate_daily_all_rooms(): void
    {
        $this->seed();
        $service = new OccupancyService();
        $rate = $service->occupancyRateDaily('2023-01-02', null);

        // Assert that the occupancy rate is calculated correctly
        $this->assertEquals(0.36, $rate);
    }

    public function test_occupancy_rate_monthly(): void
    {
        $this->seed();
        $service = new OccupancyService();
        $rate = $service->occupancyRateMonthly('2023-01', [2,3]);

        // Assert that the occupancy rate is calculated correctly
        $this->assertEquals(0.06, $rate);
    }

    public function test_occupancy_rate_monthly_all_rooms(): void
    {
        $this->seed();
        $service = new OccupancyService();
        $rate = $service->occupancyRateMonthly('2023-01', null);

        // Assert that the occupancy rate is calculated correctly
        $this->assertEquals(0.07, $rate);
    }
}
