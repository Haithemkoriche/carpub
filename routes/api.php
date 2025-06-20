<?php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\GarageController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\CompanyVehicleController;

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Vehicle routes
    Route::apiResource('vehicles', VehicleController::class);
    Route::get('/admin/vehicles/pending', [VehicleController::class, 'pendingVehicles'])
        ->middleware('role:admin');
    Route::patch('/admin/vehicles/{vehicle}/validate', [VehicleController::class, 'validateVehicle'])
        ->middleware('role:admin');

    // Campaign routes
    Route::apiResource('campaigns', CampaignController::class);
    Route::get('/campaigns/companies', [CampaignController::class, 'getCompanies'])
        ->middleware('role:admin');

    // Contract routes
    Route::apiResource('contracts', ContractController::class);
    Route::get('/contracts/{contract}/pdf', [ContractController::class, 'generatePdf'])
        ->middleware('role:admin');

    // Garage routes (admin only)
    Route::apiResource('garages', GarageController::class)
        ->middleware('role:admin');

    // Payment routes
    Route::get('/payments', [PaymentController::class, 'index']);
    Route::get('/payments/{payment}', [PaymentController::class, 'show']);
    Route::patch('/payments/{payment}', [PaymentController::class, 'update'])
        ->middleware('role:admin');
    Route::get('/contracts/{contract}/payments', [PaymentController::class, 'getByContract']);

    // Company vehicle routes
    Route::get('/entreprise/vehicules', [CompanyVehicleController::class, 'index'])
        ->middleware('role:entreprise');
});
