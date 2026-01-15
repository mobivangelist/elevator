<?php
declare(strict_types=1);

// Simple, no-composer bootstrap:
require_once __DIR__ . '/../src/Domain/DomainException.php';
require_once __DIR__ . '/../src/Domain/DoorState.php';
require_once __DIR__ . '/../src/Domain/MotionState.php';
require_once __DIR__ . '/../src/Domain/FloorRange.php';
require_once __DIR__ . '/../src/Domain/RequestQueue.php';
require_once __DIR__ . '/../src/Domain/Elevator.php';
require_once __DIR__ . '/../src/Domain/ElevatorSystem.php';

require_once __DIR__ . '/../src/App/Commands/Command.php';
require_once __DIR__ . '/../src/App/Commands/CallCommand.php';
require_once __DIR__ . '/../src/App/Commands/StepCommand.php';
require_once __DIR__ . '/../src/App/Commands/OpenCommand.php';
require_once __DIR__ . '/../src/App/Commands/CloseCommand.php';
require_once __DIR__ . '/../src/App/Commands/StatusCommand.php';
require_once __DIR__ . '/../src/App/Commands/HelpCommand.php';
require_once __DIR__ . '/../src/App/Commands/QuitCommand.php';

require_once __DIR__ . '/../src/App/CommandRouter.php';
require_once __DIR__ . '/../src/App/ConsoleApp.php';

use App\ConsoleApp;
use App\CommandRouter;
use Domain\ElevatorSystem;
use Domain\FloorRange;

$maxFloor = 9;
if (isset($argv[1]) && is_numeric($argv[1])) {
    $maxFloor = (int)$argv[1];
}

$system = new ElevatorSystem(new FloorRange(0, $maxFloor));
$router = new CommandRouter();
$app = new ConsoleApp($system, $router);

$app->run();
