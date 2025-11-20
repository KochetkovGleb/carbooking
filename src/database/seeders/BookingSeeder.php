<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bookings')->insert([
            [
                'car_id' => 1,
                'user_id' => 101,
                'start_date' => '2025-11-21',
                'end_date' => '2025-11-25',
            ],
            [
                'car_id' => 2,
                'user_id' => 102,
                'start_date' => '2025-11-22',
                'end_date' => '2025-11-23',
            ],
        ]);
    }
}
