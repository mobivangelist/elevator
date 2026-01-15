<?php

namespace App\Commands;

use Domain\ElevatorSystem;
use Domain\DomainException;
use App\DispatchResult;

final class CloseCommand implements Command
{
    public function name(): string
    {
        return 'close';
    }

    public function help(): string
    {
        return "close         - close doors";
    }

    public function run(ElevatorSystem $system, array $args): DispatchResult
    {
        // TODO:
        // - call into domain: $system->elevator()->closeDoors()
        // - return message
        throw new DomainException("Not implemented: close");
    }
}
