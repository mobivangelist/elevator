<?php

namespace Domain;

final class ElevatorSystem
{
    private Elevator $elevator;

    public function __construct(FloorRange $range)
    {
        $this->elevator = new Elevator($range, new RequestQueue());
    }

    public function elevator(): Elevator
    {
        return $this->elevator;
    }
}
