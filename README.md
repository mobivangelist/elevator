# Elevator Controller (PHP training project)

## Goal

Build a single-elevator controller with a simple command loop:

- read a line from stdin
- parse a command
- apply it to the domain model
- print a human-readable result

## Domain rules

- Building has floors 0..N (default N=9).
- Elevator has:
  - current floor
  - door state: OPEN / CLOSED
  - motion state: IDLE / MOVING_UP / MOVING_DOWN
  - a queue of requested destination floors
- `call <floor>` adds a floor request.
  - step advances the simulation by one tick:
  - If doors are open: elevator does not move.
  - If idle and there is a pending request: choose next target and set direction.
  - If moving: move by exactly 1 floor per step.
  - When arriving at a target floor: stop and open doors (optionally remove target from queue).
- `open` opens doors only if elevator is idle (or allow at any time but then motion must become idle; pick one policy and enforce it).
- `close` closes doors.
- `status` prints current state + queue.
- `help` prints commands.
- `quit` exits.

## Command list (minimal)

- `call 5`
- `step`
- `open`
- `close`
- `status`
- `help`
- `quit`

## Acceptance scenarios (examples)

1. `call 3` then `step` x3 moves from 0 → 3 and doors open on arrival.
2. If doors are open, `step` does not move (prints “doors open”).
3. `call -1` or `call 999` fails with a domain error.
4. Multiple calls queue and are processed FIFO (or “nearest next” if you want a stretch goal).

## Example REPL session

```
> status
floor=0 door=closed motion=idle target=none queue=[]
> call 3
Enqueued request to floor 3.
> step
Moved to floor 1 (target 3).
> step
Moved to floor 2 (target 3).
> step
Moved to floor 3. Arrived; doors opened.
> step
Doors are open; elevator does not move.
> close
Doors closed.
> status
floor=3 door=closed motion=idle target=none queue=[]
> quit
Bye.
```

## How to run

```bash
cd elevator
php bin/elevator.php
```
