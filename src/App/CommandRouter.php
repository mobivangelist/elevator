<?php

namespace App;

use App\Commands\Command;
use App\Commands\HelpCommand;
use App\Commands\QuitCommand;
use App\Commands\CallCommand;
use App\Commands\StepCommand;
use App\Commands\OpenCommand;
use App\Commands\CloseCommand;
use App\Commands\StatusCommand;
use Domain\ElevatorSystem;
use Domain\DomainException;

/**
 * Parses a line and dispatches to a command.
 *
 * Grammar:
 *   verb
 *   verb arg1 arg2 ...
 *
 * Keep this small. The point is for the grad to implement
 * domain behavior inside commands (or call into domain),
 * not to build a sophisticated CLI framework.
 */
final class CommandRouter
{
    /** @var array<string, Command> */
    private array $commands = [];

    public function __construct()
    {
        // Register stubs: grad fills these in.
        $this->register(new CallCommand());
        $this->register(new StepCommand());
        $this->register(new OpenCommand());
        $this->register(new CloseCommand());
        $this->register(new StatusCommand());

        // Fully implemented utility commands
        $this->register(new QuitCommand());
        $this->register(new HelpCommand(fn() => $this->all()));
    }

    public function register(Command $command): void
    {
        $this->commands[$command->name()] = $command;
    }

    /** @return Command[] */
    public function all(): array
    {
        return array_values($this->commands);
    }

    public function dispatch(string $line, ElevatorSystem $system): DispatchResult
    {
        [$verb, $args] = $this->parse($line);

        $command = $this->commands[$verb] ?? null;
        if ($command === null) {
            throw new DomainException("Unknown command '{$verb}'. Try: help");
        }

        return $command->run($system, $args);
    }

    /**
     * @return array{0:string,1:list<string>}
     */
    private function parse(string $line): array
    {
        $parts = preg_split('/\s+/', trim($line));
        $verb = strtolower((string)($parts[0] ?? ''));

        if ($verb === '') {
            throw new DomainException("Empty command. Try: help");
        }

        /** @var list<string> $args */
        $args = array_values(array_slice($parts, 1));
        return [$verb, $args];
    }
}

/**
 * Small return type so commands can signal quit without exceptions.
 */
final class DispatchResult
{
    public function __construct(
        public string $output = '',
        public bool   $shouldQuit = false,
    )
    {
    }

    public static function quit(string $message = ''): self
    {
        return new self($message, true);
    }
}
