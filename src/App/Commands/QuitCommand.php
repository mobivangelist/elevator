<?php

namespace App\Commands;

use Domain\ElevatorSystem;
use App\DispatchResult;

/**
 * Fully implemented.
 */
final class QuitCommand implements Command
{
    public function name(): string
    {
        return 'quit';
    }

    public function help(): string
    {
        return "quit          - exit";
    }

    public function run(ElevatorSystem $system, array $args): DispatchResult
    {
        return DispatchResult::quit();
    }
}
