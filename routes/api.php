<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes (no middleware)
Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Routes for SPA (with CSRF protection)
Route::prefix('v1')->middleware(['api'])->group(function () {
    Route::get('/csrf-cookie', function () {
        return response()->json(['message' => 'CSRF cookie set']);
    });
});

// Protected routes
Route::prefix('v1')->middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // Add other protected routes here
}); 