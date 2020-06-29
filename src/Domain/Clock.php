<?php

namespace SquaredPoint\Timer\Domain;

interface Clock
{
    public function now(): \DateTimeImmutable;
}