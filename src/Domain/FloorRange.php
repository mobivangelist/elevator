<?php

namespace Domain;

final class FloorRange
{
    public function __construct(private int $min, private int $max)
    {
        if ($min > $max) {
            throw new DomainException("Invalid floor range");
        }
    }

    public function assertValid(int $floor): void
    {
        if ($floor < $this->min || $floor > $this->max) {
            throw new DomainException("Floor out of range");
        }
    }

    public function min(): int
    {
        return $this->min;
    }

    public function max(): int
    {
        return $this->max;
    }
}
