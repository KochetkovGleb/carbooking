<?php

namespace App\Entities;

class Car
{
    public int $id;
    public string $brand;
    public string $model;
    public float $pricePerDay;

    public function __construct(
        int $id,
        string $brand,
        string $model,
        float $pricePerDay
    ) {
        $this->id = $id;
        $this->brand = $brand;
        $this->model = $model;
        $this->pricePerDay = $pricePerDay;
    }
}
