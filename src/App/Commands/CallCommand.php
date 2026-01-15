<?php

namespace App\Commands;

use Domain\ElevatorSystem;
use Domain\DomainException;
use App\DispatchResult;

final class CallCommand implements Command
{
    public function name(): string
    {
        return 'call';
    }

    public function help(): string
    {
        return "call <floor>   - enqueue a floor request";
    }

    public function run(ElevatorSystem $system, array $args): DispatchResult
    {
        // TODO:
        // - validate args: require numeric floor
        // - call into domain: $system->elevator()->callTo($floor)
        // - return a friendly message
        throw new DomainException("Not implemented: call");
    }
}
