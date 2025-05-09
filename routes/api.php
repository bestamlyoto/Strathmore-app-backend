<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EnergyController;
use App\Http\Controllers\API\MapController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\EnergyTypeController;
use App\Http\Controllers\AnalyticsController;

// ✅ Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Public endpoints for dropdowns (e.g., county and energy type selectors)
Route::get('/counties', [CountyController::class, 'index']);
Route::get('/energy-types', [EnergyTypeController::class, 'index']);
Route::get('/analytics', [AnalyticsController::class, 'index']);

// Public routes for map data (no authentication needed)
Route::get('/county-data', [MapController::class, 'getCountyData']);
Route::get('/county-stats/{countyId}', [MapController::class, 'getCountyStats']);

// ✅ Protected Routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::post('/submit-energy', [EnergyController::class, 'submitEnergyData']);
    Route::get('/my-submissions', [EnergyController::class, 'getUserSubmissions']);
});
