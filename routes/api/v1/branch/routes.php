<?php

use App\Http\Controllers\Api\V1\BranchController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'branches',
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/', [BranchController::class, 'index'])->name('branches.index');
    Route::post('/', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/{id}', [BranchController::class, 'show'])->name('branches.show');
    Route::put('/{id}', [BranchController::class, 'update'])->name('branches.update');
    Route::delete('/{id}', [BranchController::class, 'destroy'])->name('branches.destroy');
}); 