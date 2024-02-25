<?php

namespace App;

use App\Exceptions\OutOfGridException;
use App\Warehouse;

class Robot
{
    public int $xLocation = 1;
    public int $yLocation = 1;
    public array $pathHistory = [];
    public Warehouse $warehouse;

    public function __construct(Warehouse $warehouse)
    {
        $this->warehouse = $warehouse;
    }

    /**
     * Place the robot in the grid.
     */
    public function locate(int $x, int $y) : Robot
    {
        $this->xLocation = $x;
        $this->yLocation = $y;

        $this->checkBoundaries();

        return $this;
    }

    /**
     * Move the robot according to the paths.
     */
    public function move(array $paths) : Robot
    {
        foreach ($paths as $path) {

            // Put the current location into the history for tracking purposes.
            $this->pathHistory[] = [$this->xLocation, $this->yLocation];

            // Get the key(axis) to find out the direction of movement.
            $axis = array_key_first($path);

            switch ($axis) {
                case Warehouse::X_AXIS:
                    $this->xLocation += $path[Warehouse::X_AXIS];
                    break;
                case Warehouse::Y_AXIS:
                    $this->yLocation += $path[Warehouse::Y_AXIS];
                    break;
                default:
                    break;
            }
        }

        $this->checkBoundaries();

        return $this;
    }

    /**
     * Make sure that the robot doesn't move outside the warehouse grid.
     */
    protected function checkBoundaries() : bool|OutOfGridException
    {
        $outOfGrid = ($this->xLocation < Warehouse::X_MIM)
            || ($this->xLocation > Warehouse::X_MAX)
            || ($this->yLocation < Warehouse::Y_MIN)
            || ($this->yLocation > Warehouse::Y_MAX);

        if ($outOfGrid) {
            throw new OutOfGridException('The command sends the robot outside of the grid!');
        }

        return true;
    }
}
