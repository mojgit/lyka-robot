<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RobotController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/robot', [RobotController::class, 'index'])->name('robot.index');
Route::post('/robot/move', [RobotController::class, 'move'])->name('robot.move');
