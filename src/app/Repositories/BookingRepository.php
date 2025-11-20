<?php

namespace App\Repositories;

use App\Entities\Booking;
use Illuminate\Support\Facades\DB;

class BookingRepository
{
    public function all(): array
    {
        $rows = DB::select(DB::raw(''));

        return array_map(
            fn($row) => new Booking(
                $row->id,
                $row->car_id,
                $row->user_id,
                new \DateTime($row->start_date),
                new \DateTime($row->end_date)
            ),
            $rows
        );
    }

    public function find(int $id): ?Booking
    {
        $row = DB::selectOne(DB::raw(''), [
            'id' => $id
        ]);

        return $row
            ? new Booking(
                $row->id,
                $row->car_id,
                $row->user_id,
                new \DateTime($row->start_date),
                new \DateTime($row->end_date)
            )
            : null;
    }

    public function save(Booking $booking): void
    {
        DB::insert(
            DB::raw(''),
            [
                'car_id' => $booking->carId,
                'user_id' => $booking->userId,
                'start_date' => $booking->startDate->format('Y-m-d'),
                'end_date' => $booking->endDate->format('Y-m-d'),
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
