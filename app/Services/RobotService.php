<?php

namespace App\Services;

use App\Robot;
use App\Warehouse;
use App\Enums\Commands;
use App\DataObjects\MovementData;

class RobotService
{
    protected Robot $robot;

    /**
     * Class Constructor.
     */
    public function __construct(Robot $robot)
    {
        $this->robot = $robot;
    }

    /**
     * Run the move command based on the current robot location.
     */
    public function runCommand(int $xLocation, int $yLocation, string $command) : array
    {
        $paths = $this->translateCommand($command);

        $robot = $this->robot
            ->locate($xLocation, $yLocation)
            ->move($paths);

        $data = new MovementData($robot->xLocation, $robot->yLocation, $robot->pathHistory);

        return $data->toArray();
    }

    /**
     * Convert the command string into array of movements.
     */
    public function translateCommand(string $command) : array
    {
        $paths = [];

        $commands = explode(' ', trim($command));

        foreach ($commands as $command) {
            switch ($command) {
                case Commands::NORTH->value:
                    $paths[] = [Warehouse::Y_AXIS => 1];
                    break;
                case Commands::SOUTH->value:
                    $paths[] = [Warehouse::Y_AXIS => -1];
                    break;
                case Commands::EAST->value:
                    $paths[] = [Warehouse::X_AXIS => 1];
                    break;
                case Commands::WEST->value:
                    $paths[] = [Warehouse::X_AXIS => -1];
                    break;
                default:
                    break;
            }
        }

        return $paths;
    }
}
