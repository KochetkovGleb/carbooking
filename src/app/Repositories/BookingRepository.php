<?php

namespace App\Repositories;

use DateTime;
use App\Entities\Booking;
use Illuminate\Support\Facades\DB;

class BookingRepository
{
    public function all(): array
    {
        $data = DB::select(DB::raw('SELECT * FROM bookings'));

        return array_map(
            fn($row) => new Booking(
                $row->id,
                $row->car_id,
                $row->user_id,
                new DateTime($row->start_date),
                new DateTime($row->end_date)
            ),
            $data
        );
    }

    public function find(int $id): ?Booking
    {
        $data = DB::selectOne(
            DB::raw('SELECT * FROM bookings WHERE id = :id'),
            ['id' => $id]
        );

        if (!$data) {
            return null;
        }

        return new Booking(
            $data->id,
            $data->car_id,
            $data->user_id,
            new DateTime($data->start_date),
            new DateTime($data->end_date)
        );
    }


    public function save(Booking $booking): void
    {
        DB::insert(
            DB::raw('INSERT INTO bookings (car_id, user_id, start_date, end_date) VALUES (:car_id, :user_id, :start_date, :end_date)'),
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
        DB::delete(DB::raw('DELETE FROM bookings WHERE id = :id'), [
            'id' => $id
        ]);
    }
}
