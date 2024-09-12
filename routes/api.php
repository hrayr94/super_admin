<?php

use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;




//api/auth
Route::middleware('throttle:10,1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('/check-code', [ForgotPasswordController::class, 'checkResetCode']);
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);
});

Route::get('test', function () {
    dd('test');
});

Route::middleware(['auth:api', 'verified'])->prefix('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user', [AuthController::class, 'user']);
});

//api/admin
Route::middleware(['auth:api','verified','admin',])->prefix('admin')->group(function () {
    Route::apiResource('users', UserController::class);
});

