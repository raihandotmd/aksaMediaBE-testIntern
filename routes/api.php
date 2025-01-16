<?php

use App\Http\Controllers\api\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);
