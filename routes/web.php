<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TiketController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('movies', MovieController::class);
Route::resource('tikets', TiketController::class);

Route::get('/scanner', [TiketController::class, 'scanner'])->name('tikets.scanner');
Route::post('/tikets/scan', [TiketController::class, 'scan'])->name('tikets.scan');
Route::put('/tikets/{id}/cancel', [App\Http\Controllers\TiketController::class, 'cancel'])->name('tikets.cancel');