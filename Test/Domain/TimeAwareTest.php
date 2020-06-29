<?php

use \SquaredPoint\Timer\Domain\ControlledClock;

class TimeAwareTest extends \PHPUnit\Framework\TestCase
{
    protected $clock;

    public function setUp(): void
    {
        parent::setUp();
        $this->clock = new ControlledClock(new \DateTime("2020-06-29"));
    }

    /**
     * @param int $seconds
     * @return DateTimeImmutable
     * @throws Exception
     */
    protected function addSecondsToClock(int $seconds): \DateTimeImmutable
    {
        return $this->clock->addSeconds($seconds);
    }


    /** @test */
    public function it_uses_time_aware_base_test_class()
    {
        $this->assertTrue(true);
    }
}