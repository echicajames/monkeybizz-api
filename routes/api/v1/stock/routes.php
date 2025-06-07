<?php

use App\Http\Controllers\Api\V1\StockController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'stocks',
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/', [StockController::class, 'index'])->name('stocks.index');
    Route::post('/', [StockController::class, 'store'])->name('stocks.store');
    Route::get('/{id}', [StockController::class, 'show'])->name('stocks.show');
    Route::put('/{id}', [StockController::class, 'update'])->name('stocks.update');
    Route::delete('/{id}', [StockController::class, 'destroy'])->name('stocks.destroy');
}); 