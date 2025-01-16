<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\DivisionModelController;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('divisions', [DivisionModelController::class, 'index']);
});
