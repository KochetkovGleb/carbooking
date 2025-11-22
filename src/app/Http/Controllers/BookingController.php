<?php

namespace App\Http\Controllers;

use App\Entities\Booking;
use App\Repositories\BookingRepository;
use DateTime;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private BookingRepository $bookingRepository;

    public function __construct(BookingRepository $bookingRepository) {
        $this->bookingRepository = $bookingRepository;
    }

    public function index()
    {
        return response()->json($this->bookingRepository->all());
    }

    public function show(int $id)
    {
        $booking = $this->bookingRepository->find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return response()->json($booking);
    }


    public function store(Request $request)
    {
        $data = [
            'car_id'     => $request->car_id,
            'user_id'    => $request->user_id,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
        ];


        $booking = new Booking(
            0, // id
            $data['car_id'],
            $data['user_id'],
            new DateTime($data['start_date']),
            new DateTime($data['end_date'])
        );

        $this->bookingRepository->save($booking);

        return response()->json([
            'message' => 'Booking created successfully',
            'booking' => $booking
        ], 201);
    }

    public function destroy(int $id)
    {
        $booking = $this->bookingRepository->find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $this->bookingRepository->delete($id);

        return response()->noContent();
    }

}
