<?php

namespace App\Repositories;

use App\Entities\Car;
use Illuminate\Support\Facades\DB;

class CarRepository
{

    public function all(): array
    {
        $data = DB::select(DB::raw('SELECT * FROM cars'));

        return array_map(
            fn($car) => new Car(
                $car->id,
                $car->brand,
                $car->model,
                $car->price_per_day
            ),
            $data
        );
    }


    public function find(int $id): ?Car
    {
        $row = DB::selectOne(DB::raw(''), [
            'id' => $id
        ]);

        return $row
            ? new Car($row->id, $row->brand, $row->model, $row->price_per_day)
            : null;
    }


    public function save(Car $car): void
    {
        DB::insert(
            DB::raw(''),
            [
                'brand' => $car->brand,
                'model' => $car->model,
                'price' => $car->pricePerDay
            ]
        );
    }


    public function delete(int $id): void
    {
        DB::delete(DB::raw(''), [
            'id' => $id
        ]);
    }
}
