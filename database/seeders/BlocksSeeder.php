<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blocks')->insert([
            'room_id' => 2,
            'starts_at' => '2023-01-01',
            'ends_at' => '2023-01-10',
        ]);
    }
}
