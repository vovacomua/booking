<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OccupancyController;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/daily-occupancy-rates/{date}', [OccupancyController::class, 'daily'])
    ->where('date', '^[0-9]{4}-[0-9]{2}-[0-9]{2}$');
Route::get('/monthly-occupancy-rates/{date}', [OccupancyController::class, 'monthly'])
    ->where('date', '^[0-9]{4}-[0-9]{2}$');

Route::post('/booking', [BookingController::class, 'store']);
Route::put('/booking/{booking}', [BookingController::class, 'update']);


