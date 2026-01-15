<?php

namespace App\Commands;

use Domain\ElevatorSystem;
use Domain\DomainException;
use App\DispatchResult;

final class StepCommand implements Command
{
    public function name(): string
    {
        return 'step';
    }

    public function help(): string
    {
        return "step          - advance simulation by 1 tick";
    }

    public function run(ElevatorSystem $system, array $args): DispatchResult
    {
        // TODO:
        // - call into domain: $system->elevator()->step()
        // - return whatever step() returns
        throw new DomainException("Not implemented: step");
    }
}
