<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group.
|
*/

// API Version 1
Route::prefix('v1')->group(function () {
    // Include authentication routes
    require base_path('routes/api/v1/auth/routes.php');
    
    // Include user management routes
    require base_path('routes/api/v1/user/routes.php');
    
    // Include stock management routes
    require base_path('routes/api/v1/stock/routes.php');
    
    // CSRF cookie route for SPA
    Route::get('/csrf-cookie', function () {
        return response()->json(['message' => 'CSRF cookie set']);
    });
}); 