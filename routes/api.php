<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TravelOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/order', [TravelOrderController::class, 'store']);
    Route::get('/order', [TravelOrderController::class, 'index']);
    Route::get('/order/{id}', [TravelOrderController::class, 'show']);
    Route::patch('/order', [TravelOrderController::class, 'update']);
});
