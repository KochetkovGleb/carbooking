<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cars')->insert([
            [
                'brand' => 'Toyota',
                'model' => 'Camry',
                'price_per_day' => 2000,
            ],
            [
                'brand' => 'BMW',
                'model' => 'X5',
                'price_per_day' => 4000,
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Veloz',
                'price_per_day' => 2500,
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Ativ',
                'price_per_day' => 1000,
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Yaris',
                'price_per_day' => 900,
            ],
        ]);
    }
}
