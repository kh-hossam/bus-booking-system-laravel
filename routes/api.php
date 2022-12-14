<?php

use App\Http\Controllers\PassengerAuthController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\StationController;
use App\Http\Controllers\Api\TripController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [PassengerAuthController::class, 'register']);
Route::post('/login', [PassengerAuthController::class, 'login']);


Route::group(['middleware'=> ['auth:sanctum']], function () {
    Route::get('/lookups/stations', [StationController::class, 'index']);

    Route::get('/trips-seats', [TripController::class, 'index']);
    Route::post('/reservation', [ReservationController::class, 'store']);

    Route::post('/logout', [PassengerAuthController::class, 'logout']);

});
