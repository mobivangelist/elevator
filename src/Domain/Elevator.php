<?php

namespace Domain;

final class Elevator
{
    private int $floor = 0;
    private DoorState $door = DoorState::CLOSED;
    private MotionState $motion = MotionState::IDLE;
    private ?int $target = null;

    public function __construct(
        private FloorRange   $range,
        private RequestQueue $queue
    )
    {
    }

    public function callTo(int $floor): void
    {
        $this->range->assertValid($floor);
        $this->queue->enqueue($floor);
    }

    public function openDoors(): void
    {
        if ($this->motion !== MotionState::IDLE) {
            throw new DomainException("Cannot open while moving");
        }
        $this->door = DoorState::OPEN;
    }

    public function closeDoors(): void
    {
        $this->door = DoorState::CLOSED;
    }

    public function step(): string
    {
        if ($this->door === DoorState::OPEN) {
            return "Doors open; no movement.";
        }

        if ($this->target === null) {
            $this->target = $this->queue->dequeue();
            if ($this->target === null) {
                return "Idle.";
            }
        }

        if ($this->floor < $this->target) {
            $this->motion = MotionState::MOVING_UP;
            $this->floor++;
        } elseif ($this->floor > $this->target) {
            $this->motion = MotionState::MOVING_DOWN;
            $this->floor--;
        }

        if ($this->floor === $this->target) {
            $this->motion = MotionState::IDLE;
            $this->door = DoorState::OPEN;
            $this->target = null;
            return "Arrived; doors opened.";
        }

        return "Moved to floor {$this->floor}.";
    }

    public function status(): string
    {
        return sprintf(
            "floor=%d door=%s motion=%s target=%s queue=[%s]",
            $this->floor,
            $this->door->value,
            $this->motion->value,
            $this->target ?? 'none',
            implode(',', $this->queue->all())
        );
    }
}
