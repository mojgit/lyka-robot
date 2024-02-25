<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\RobotMoveRequest;
use \Illuminate\Http\RedirectResponse;
use App\Services\RobotService;
use App\DataObjects\MovementData;

class RobotController extends Controller
{
    protected RobotService $robotService;

    /**
     * Class Constructor.
     */
    public function __construct(RobotService $robotService)
    {
        $this->robotService = $robotService;
    }

    /**
     * Show the robot index page.
     */
    public function index(Request $request) : View
    {
        $xLocation = $request->input('xLocation') ? (int) $request->input('xLocation') : 1;
        $yLocation = $request->input('yLocation') ? (int) $request->input('yLocation') : 1;
        $pathHistory = $request->input('pathHistory') ?: [];

        $data = new MovementData($xLocation, $yLocation, $pathHistory);

        return view('robot.index')
            ->with($data->toArray());
    }

    /**
     * Execute the move command.
     */
    public function move(RobotMoveRequest $request) : RedirectResponse
    {
        $xLocation = $request->input('xLocation') ? (int) $request->input('xLocation') : 1;
        $yLocation = $request->input('yLocation') ? (int) $request->input('yLocation') : 1;
        $command = $request->command;

        try {
            $data = $this->robotService->runCommand($xLocation, $yLocation, $command);

            return redirect()->route('robot.index', $data);

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['command' => $e->getMessage()]);
        }
    }
}
