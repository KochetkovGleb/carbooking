<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Services\CarService;
use App\Dto\CarDTO;

class CarController extends Controller
{
    private CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function index()
    {
        return response()->json(
            $this->carService->getAllCars()
        );
    }

    public function show(int $id)
    {
        return response()->json(
            $this->carService->getCarById($id)
        );
    }

    public function store(CarRequest $request)
    {
        $carDTO = CarDTO::fromRequest($request);

        $car = $this->carService->createCar($carDTO);

        return response()->json($car, 201);
    }

    public function destroy(int $id)
    {
        $this->carService->deleteCar($id);

        return response()->noContent();
    }
}

