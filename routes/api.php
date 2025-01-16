<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\DivisionController;
use App\Http\Controllers\api\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\SqlTestController;


Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('divisions', [DivisionController::class, 'index']);


    Route::get('employees', [EmployeeController::class, 'index']);
    Route::post('employees', [EmployeeController::class, 'store']);
    Route::put('employees/{uuid}', [EmployeeController::class, 'update']);
    Route::delete('employees/{uuid}', [EmployeeController::class, 'destroy']);
});


// SQL Test
Route::get('nilaiRT', [SqlTestController::class, 'calculateNilaiRT']);
Route::get('nilaiST', [SqlTestController::class, 'calculateNilaiST']);
