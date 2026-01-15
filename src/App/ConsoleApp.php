<?php

namespace App;

use Domain\ElevatorSystem;
use Domain\DomainException;

/**
 * Minimal REPL shell.
 * - Reads one line at a time from STDIN
 * - Routes to a command handler
 * - Prints returned messages
 *
 * Intentionally contains NO domain logic (no elevator rules).
 */
final class ConsoleApp
{
    public function __construct(
        private ElevatorSystem $system,
        private CommandRouter  $router
    )
    {
    }

    public function run(): void
    {
        $this->println("Elevator REPL. Type 'help' for commands. Type 'quit' to exit.");

        while (true) {
            $this->print("> ");
            $line = fgets(STDIN);

            if ($line === false) {
                $this->println("\nEOF. Exiting.");
                return;
            }

            $line = trim($line);
            if ($line === '') {
                continue;
            }

            try {
                $result = $this->router->dispatch($line, $this->system);

                if ($result->shouldQuit) {
                    $this->println("Bye.");
                    return;
                }

                if ($result->output !== '') {
                    $this->println($result->output);
                }
            } catch (DomainException $e) {
                $this->println("ERR: " . $e->getMessage());
            } catch (\Throwable $t) {
                // Keep REPL alive on unexpected crashes.
                $this->println("CRASH: " . $t->getMessage());
            }
        }
    }

    private function print(string $s): void
    {
        fwrite(STDOUT, $s);
    }

    private function println(string $s): void
    {
        fwrite(STDOUT, $s . PHP_EOL);
    }
}
