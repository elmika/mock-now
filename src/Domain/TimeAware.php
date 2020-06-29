<?php

namespace SquaredPoint\Timer\Domain;

abstract class TimeAware
{
    private $clock;

    protected function __construct()
    {
        $this->clock = new SystemClock();
    }

    protected function now(): \DateTimeImmutable
    {
        return $this->clock->getNow();
    }

    protected function setClock(Clock $clock) : TimeAware
    {
        $this->clock = $clock;
        return $this;
    }
}