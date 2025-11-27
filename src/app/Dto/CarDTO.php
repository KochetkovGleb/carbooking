<?php

namespace App\Dto;

use App\Http\Requests\CarRequest;
use Illuminate\Http\Request;

class CarDTO
{
    public string $brand;
    public string $model;
    public float $pricePerDay;

    public function __construct(string $brand, string $model, float $pricePerDay)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->pricePerDay = $pricePerDay;
    }

    public static function fromRequest(CarRequest $request): self
    {
        return new self(
            $request->brand,
            $request->model,
            $request->price_per_day,
        );
    }
}

