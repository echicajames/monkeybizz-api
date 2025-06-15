<?php

use App\Http\Controllers\Api\V1\InventoryController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'inventory',
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/', [InventoryController::class, 'index'])->name('inventory.index');
    Route::post('/', [InventoryController::class, 'store'])->name('inventory.store');
    Route::get('/{id}', [InventoryController::class, 'show'])->name('inventory.show');
    Route::put('/{id}', [InventoryController::class, 'update'])->name('inventory.update');
    Route::delete('/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
}); 