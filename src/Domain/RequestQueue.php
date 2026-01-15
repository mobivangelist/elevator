<?php

namespace Domain;

final class RequestQueue
{
    private array $floors = [];

    public function enqueue(int $floor): void
    {
        if (!in_array($floor, $this->floors, true)) {
            $this->floors[] = $floor;
        }
    }

    public function dequeue(): ?int
    {
        return array_shift($this->floors);
    }

    public function all(): array
    {
        return $this->floors;
    }
}
