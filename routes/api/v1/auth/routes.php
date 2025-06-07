<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register'])
    ->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])
    ->name('auth.login');

// Protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('auth.logout');
    Route::get('/user', [AuthController::class, 'user'])
        ->name('auth.user');
}); 