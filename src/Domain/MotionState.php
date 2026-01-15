<?php

namespace Domain;

enum MotionState: string
{
    case IDLE = 'idle';
    case MOVING_UP = 'moving_up';
    case MOVING_DOWN = 'moving_down';
}
