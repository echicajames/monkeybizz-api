<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'users',
    'middleware' => ['auth:sanctum']
], function () {
    // User profile management routes will go here
    // Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
    // Route::put('/profile', [UserController::class, 'updateProfile'])->name('users.profile.update');
}); 