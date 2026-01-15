<?php

namespace Domain;

enum DoorState: string
{
    case OPEN = 'open';
    case CLOSED = 'closed';
}
