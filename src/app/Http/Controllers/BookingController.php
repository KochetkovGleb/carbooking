<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Services\BookingService;
use App\Dto\BookingDTO;

class BookingController extends Controller
{
    private BookingService $bookingService;

    public function __construct(
        BookingService $bookingService
    ) {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        return response()->json(
            $this->bookingService->getAllBookings()
        );
    }

    public function show(int $id)
    {
        return response()->json(
            $this->bookingService->getBookingById($id)
        );
    }

    public function store(BookingRequest $request)
    {
        $bookingDTO = BookingDTO::fromRequest($request);

        $booking = $this->bookingService->createBooking($bookingDTO);

        return response()->json($booking, 201);
    }

    public function destroy(int $id)
    {
        $this->bookingService->deleteBooking($id);

        return response()->noContent();
    }
}

