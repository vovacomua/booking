<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms')->insert([
            'capacity' => 6,
        ]);
        DB::table('rooms')->insert([
            'capacity' => 4,
        ]);
        DB::table('rooms')->insert([
            'capacity' => 2,
        ]);
    }
}
