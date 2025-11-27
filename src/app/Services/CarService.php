<?php

namespace App\Services;

use App\Dto\CarDTO;
use App\Entities\Car;
use App\Repositories\CarRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CarService
{
    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function createCar(CarDTO $carDTO): Car
    {
        $car = new Car(
            0,
            $carDTO->brand,
            $carDTO->model,
            $carDTO->pricePerDay
        );

        $this->carRepository->save($car);

        return $car;
    }

    public function getAllCars(): array
    {
        return $this->carRepository->all();
    }

    public function getCarById(int $id): ?Car
    {
        $car = $this->carRepository->find($id);

        if (is_null($car)) {
            throw new ModelNotFoundException("Car not found");
        }
        return $car;
    }

    public function deleteCar(int $id)
    {
        $isDeleted = $this->carRepository->delete($id);

        if (!$isDeleted) {
            throw new ModelNotFoundException("Car {$id} not found.");
        }
    }
}
