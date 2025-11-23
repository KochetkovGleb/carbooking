<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Services\CarService;
use App\Dto\CarDTO;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CarController extends Controller
{
    private CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function index()
    {
        $cars = $this->carService->getAllCars();

        return response()->json($cars);
    }

    public function show(int $id)
    {
        $car = $this->carService->getCarById($id);
        return response()->json($car);
    }

    public function store(CarRequest $request)
    {

        $carDTO = CarDTO::fromRequest($request);


        $car = $this->carService->createCar($carDTO);

        return response()->json([
            'message' => 'Car created successfully',
            'car' => $car
        ], 201);
    }

    public function destroy(int $id)
    {
        try {
            $this->carService->deleteCar($id);

            return response()->noContent();
        } catch (NotFoundHttpException $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }
}

