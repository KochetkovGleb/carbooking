<?php

namespace App\Services;

use App\Dto\BookingDTO;
use App\Entities\Booking;
use App\Repositories\BookingRepository;
use DateTime;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookingService
{
    private BookingRepository $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function createBooking(BookingDTO $bookingDTO)
    {
        $isAvailable = $this->bookingRepository->checkBookingAvailability($bookingDTO);

        if (!$isAvailable) {
            return false;
        }

        $startDate = new \DateTime($bookingDTO->startDate);
        $endDate = new \DateTime($bookingDTO->endDate);

        $booking = new Booking(
            0,
            $bookingDTO->carId,
            $bookingDTO->userId,
            $startDate,
            $endDate
        );

        $this->bookingRepository->save($booking);

        return $booking;
    }


    public function getAllBookings(): array
    {
        return $this->bookingRepository->all();
    }

    public function getBookingById(int $id): ?Booking
    {
        return $this->bookingRepository->find($id);
    }

    public function deleteBooking(int $id)
    {
        $isDeleted = $this->bookingRepository->delete($id);

        if (!$isDeleted) {
            throw new ModelNotFoundException("Booking {$id} not found.");
        }

        return true;
    }
}
