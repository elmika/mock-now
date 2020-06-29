<?php


namespace SquaredPoint\Timer\Domain;

class TimeBoundedResource extends TimeAware
{
    private $bookTime;
    private $timeout;

    public function __construct()
    {
        parent::__construct();
        $this->timeout = 60 * 5; // 5 minutes
    }

    public function book()
    {
        $this->bookTime = $this->now();
    }

    private function isBooked()
    {
        if(is_null($this->bookTime)){
            return false;
        }
        return true;
    }

    /**
     * @return bool
     * @throws TimeoutException
     * @throws BookingRequiredException
     */
    public function confirm() : bool
    {
        if(! $this->isBooked())
        {
            throw new BookingRequiredException(
                "Booking needs to be done before any confirmation can occur."
            );
        }
        if($this->secondsSinceBookingIsHigherThan($this->timeout))
        {
            throw new TimeoutException(
                "Booking has expired. Please make a new booking, and confirm again."
            );
        }

        return true;
    }

    /**
     * @return \DateTimeImmutable
     * @throws BookingRequiredException
     */
    private function bookTime(): \DateTimeImmutable
    {
        if(! $this->isBooked())
        {
            throw new BookingRequiredException(
                "Booking needs to be done before book time can be accessed."
            );
        }

        return $this->bookTime;
    }

    /**
     * @param int timeout in seconds
     * @return bool true if time is over
     * @throws BookingRequiredException
     */
    private function secondsSinceBookingIsHigherThan(int $timeout): bool
    {
        $elapsedSeconds = $this->now()->getTimestamp() - $this->bookTime()->getTimestamp();
        if($elapsedSeconds > $timeout)
        {
            return true;
        }

        return false;
    }
}