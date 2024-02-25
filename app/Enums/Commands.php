<?php

namespace App\Enums;

enum Commands: string
{
    case NORTH = 'N';
    case SOUTH = 'S';
    case EAST = 'E';
    case WEST = 'W';
}
