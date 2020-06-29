<?php

use SquaredPoint\Timer\Domain\TimeBoundedResource;
use SquaredPoint\Timer\Domain\TimeoutException;

class TimeBoundedResourceTest extends TimeAwareTest
{
    private $resource;

    public function setUp(): void
    {
        parent::setUp();
        $this->resource = new TimeBoundedResource($this->clock);
    }

    /** @test */
    public function it_should_confirm_booking()
    {
        $this->resource->book();
        $this->addSecondsToClock(4*60);
        $this->assertTrue($this->resource->confirm(), "Booking confirmed after 4 minutes.");
    }

    /** @test */
    public function it_should_timeout()
    {
        $this->expectException(TimeoutException::class);
        ;
        $this->resource->book();
        $this->addSecondsToClock(6*60);
        $this->resource->confirm();
    }
}