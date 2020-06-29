<?php
namespace SquaredPoint\Timer\Domain;

use \SquaredPoint\Timer\Domain\Clock;

class ControlledClock implements Clock
{
    private $timer;

    public function __construct(\DateTime $timer)
    {
        $this->timer = $timer;
    }

    public function now(): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromMutable($this->timer);
    }

    /**
     * @param int $seconds
     * @return DateTimeImmutable
     * @throws Exception
     */
    public function addSeconds(int $seconds): \DateTimeImmutable
    {
        $this->timer->add(new \DateInterval("PT".$seconds . "S"));
        return $this->now();
    }
}