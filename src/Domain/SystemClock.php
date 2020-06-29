<?php


namespace SquaredPoint\Timer\Domain;

class SystemClock implements Clock
{
    public function now() : \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}