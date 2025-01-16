<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\DivisionController;
use App\Http\Controllers\api\EmployeeController;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('divisions', [DivisionController::class, 'index']);


    Route::get('employees', [EmployeeController::class, 'index']);
});
