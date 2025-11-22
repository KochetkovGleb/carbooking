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
        $data = DB::selectOne(
            DB::raw('SELECT * FROM cars WHERE id = :id'),
            ['id' => $id]
        );

        if (!$data) {
            return null;
        }

        return new Car(
            $data->id,
            $data->brand,
            $data->model,
            $data->price_per_day
        );
    }


    public function save(Car $car): void
    {
        DB::insert(
            DB::raw('
            INSERT INTO cars (brand, model, price_per_day)
            VALUES (:brand, :model, :price_per_day)
        '),
            [
                'brand'        => $car->brand,
                'model'        => $car->model,
                'price_per_day'=> $car->pricePerDay,
            ]
        );

        $car->id = (int) DB::getPdo()->lastInsertId();
    }



    public function delete(int $id): void
    {
        DB::delete(DB::raw('DELETE FROM cars WHERE id = :id'), [
            'id' => $id
        ]);
    }
}
