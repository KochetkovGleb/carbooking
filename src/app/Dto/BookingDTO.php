<?php

namespace App\Dto;

use Illuminate\Http\Request;

class BookingDTO
{
    public int $carId;
    public int $userId;
    public string $startDate;
    public string $endDate;

    public function __construct(int $carId, int $userId, string $startDate, string $endDate)
    {
        $this->carId = $carId;
        $this->userId = $userId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public static function fromRequest(Request $request): self
    {
        $userId = auth()->user()->id;

        return new self(
            $request->car_id,
            $userId,
            $request->start_date,
            $request->end_date,
        );
    }
}
