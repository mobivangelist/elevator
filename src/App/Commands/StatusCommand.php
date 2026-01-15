<?php
declare(strict_types=1);

namespace App\Commands;

use Domain\ElevatorSystem;
use Domain\DomainException;
use App\DispatchResult;

final class StatusCommand implements Command
{
    public function name(): string { return 'status'; }

    public function help(): string { return "status        - show elevator state"; }

    public function run(ElevatorSystem $system, array $args): DispatchResult
    {
        // TODO (grad):
        // - read state from domain (e.g., currentFloor, doorState, queue...)
        // - format as a single-line summary
        throw new DomainException("Not implemented: status");
    }
}
