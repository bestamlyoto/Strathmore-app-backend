<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EnergyController;
use App\Http\Controllers\API\MapController;
use App\Http\Controllers\CountyDataController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/getCounties',[AuthController::class,'getCounties']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/energy-types', [EnergyController::class, 'getEnergyTypes']);
    Route::post('/submit-energy', [EnergyController::class, 'submitEnergyData']);
    Route::get('/my-submissions', [EnergyController::class, 'getUserSubmissions']);

    Route::get('/county-data', [MapController::class, 'getCountyData']);
    Route::get('/county-stats/{countyId}', [MapController::class, 'getCountyStats']);
});
