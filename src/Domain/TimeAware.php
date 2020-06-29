<?php

namespace SquaredPoint\Timer\Domain;

abstract class TimeAware
{
    private $clock;

    /**
     * TimeAware constructor.
     * @param Clock|null $clock Defaults to system time
     */
    protected function __construct(?Clock $clock=null)
    {
        $this->clock = is_null($clock) ? new SystemClock() : $clock;
    }

    protected function now(): \DateTimeImmutable
    {
        return $this->clock->now();
    }
}