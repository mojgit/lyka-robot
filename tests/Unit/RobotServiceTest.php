<?php

namespace Tests\Unit;

// use Illuminate\Validation\ValidationException;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Services\RobotService;
use App\Enums\Commands;
use App\Robot;
use App\Warehouse;
use App\DataObjects\MovementData;
use App\Exceptions\OutOfGridException;

class RobotServiceTest extends TestCase
{
    protected RobotService $robotService;

    public function setUp() : void
    {
        parent::setUp();

        $this->robotService = resolve(RobotService::class);
    }

    /**
     * Test the translate command.
     */
    public function test_translate_command() : void
    {
        $command = Commands::NORTH->value . " " .
            Commands::EAST->value . " " .
            Commands::SOUTH->value . " " .
            Commands::WEST->value;

        $expected = [
            [Warehouse::Y_AXIS => 1],
            [Warehouse::X_AXIS => 1],
            [Warehouse::Y_AXIS => -1],
            [Warehouse::X_AXIS => -1]
        ];

        $result = $this->robotService->translateCommand($command);

        $this->assertEquals($result, $expected);
    }

    /**
     * Test the run command.
     */
    public function test_run_command() : void
    {
        $command = Commands::NORTH->value . " " . Commands::EAST->value;
        $movementData = new MovementData(6, 6, [
            [5, 5],
            [5, 6]
        ]);

        $expected = $movementData->toArray();

        $result = $this->robotService->runCommand(5, 5, $command);

        $this->assertEquals($result, $expected);
    }

    /**
     * Test the run command fails if it sends the robot outside of the grid boundaries.
     */
    public function test_run_command_fails_if_robot_goes_out_of_grid() : void
    {
        $command = Commands::WEST->value . " " . Commands::SOUTH->value;

        $this->expectException(OutOfGridException::class);

        $this->robotService->runCommand(1, 1, $command);
    }
}
