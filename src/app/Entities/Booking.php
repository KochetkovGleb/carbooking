<?php

namespace App\Entities;

use DateTime;

class Booking
{
    public int $id;
    public int $carId;
    public int $userId;
    public DateTime $startDate;
    public DateTime $endDate;

    public function __construct(
        int $id,
        int $carId,
        int $userId,
        DateTime $startDate,
        DateTime $endDate
    ) {
        $this->id = $id;
        $this->carId = $carId;
        $this->userId = $userId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
}

