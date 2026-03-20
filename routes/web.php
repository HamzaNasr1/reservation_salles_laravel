<?php

use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

#Route::get('/', function () {
#    return view('welcome');
#});
Route::get('/', [RoomController::class, 'index'])->name('rooms.index');
Route::post('/reservations', [RoomController::class, 'store'])->name('reservations.store');

