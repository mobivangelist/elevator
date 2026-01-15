<?php

namespace App\Commands;

use Domain\ElevatorSystem;
use Domain\DomainException;
use App\DispatchResult;

final class OpenCommand implements Command
{
    public function name(): string
    {
        return 'open';
    }

    public function help(): string
    {
        return "open          - open doors (policy defined in domain)";
    }

    public function run(ElevatorSystem $system, array $args): DispatchResult
    {
        // TODO:
        // - call into domain: $system->elevator()->openDoors()
        // - return message
        throw new DomainException("Not implemented: open");
    }
}
