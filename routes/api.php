<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TiketController;

Route::apiResource('movies', MovieController::class);
Route::apiResource('tikets', TiketController::class);

Route::post('/tikets/scan', [TiketController::class, 'scan']);