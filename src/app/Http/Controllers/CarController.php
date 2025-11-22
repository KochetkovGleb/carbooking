<?php

namespace App\Http\Controllers;

use App\Entities\Car;
use App\Repositories\CarRepository;
use Illuminate\Http\Request;

class CarController extends Controller
{
    private CarRepository $carsRepository;

    public function __construct(CarRepository $carsRepository) {
        $this->carsRepository = $carsRepository;
    }

    public function index()
    {
        return response()->json($this->carsRepository->all());
    }

    public function show($id)
    {
        return response()->json($this->carsRepository->find($id));
    }

    public function store(Request $request)
    {
        $data = [
            'brand' => $request->brand,
            'model' => $request->model,
            'price_per_day' => $request->price_per_day
        ];

        $car = new Car(
            0,
            $data['brand'],
            $data['model'],
            $data['price_per_day']
        );

        $this->carsRepository->save($car);

        return response()->json([
            'message' => 'Car created successfully',
            'car' => $car
        ], 201);
    }

    public function destroy($id)
    {
        $car = $this->carsRepository->find($id);

        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }

        $this->carsRepository->delete($id);

        return response()->noContent();
    }

}
