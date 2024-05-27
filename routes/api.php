<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LocationController;

Route::get('/', function () {
    return response()->json([
        'message' => 'This is Location Management System API. Everyone can see it.'
    ]);
});

Route::apiResource('locations', LocationController::class);
Route::get('/route/{id}', [LocationController::class, 'route']);