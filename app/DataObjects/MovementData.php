<?php

namespace App\DataObjects;

use App\DataObjects\DataObjectInterface;
use App\Warehouse;

final class MovementData implements DataObjectInterface
{
    public int $x;
    public int $y;
    public array $history = [];

    public function __construct(int $x, int $y, array $history = [])
    {
        $this->x = $x;
        $this->y = $y;
        $this->history = $history;
    }

    public function __get($key)
    {
        return $this->$key;
    }

    public function __set($key, $value)
    {
        $this->$key = strip_tags($value);
    }

    public function toArray() : array
    {
        return [
            'xLocation' => $this->x,
            'yLocation' => $this->y,
            'pathHistory' => $this->history,
            'xMin' => Warehouse::X_MIM,
            'xMax' => Warehouse::X_MAX,
            'yMin' => Warehouse::Y_MIN,
            'yMax' => Warehouse::Y_MAX,
        ];
    }
}
