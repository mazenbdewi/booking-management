<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/bookings', [BookingController::class, 'store']);
Route::middleware('auth:sanctum')->get('/bookings', [BookingController::class, 'index']);
