<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Services\BookingService;
use App\Dto\BookingDTO;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BookingController extends Controller
{
    private BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index()
    {
        $bookings = $this->bookingService->getAllBookings();
        return response()->json($bookings);
    }

    public function show(int $id)
    {
        $booking = $this->bookingService->getBookingById($id);
        return response()->json($booking);
    }

    public function store(BookingRequest $request)
    {
        $bookingDTO = BookingDTO::fromRequest($request);

        $booking = $this->bookingService->createBooking($bookingDTO);

        return response()->json([
            'message' => 'Booking created successfully',
            'booking' => $booking
        ], 201);
    }

    public function destroy(int $id)
    {
        try {
            $this->bookingService->deleteBooking($id);

            return response()->noContent();
        } catch (NotFoundHttpException $e) {

            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }
}
