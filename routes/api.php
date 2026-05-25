<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/tasks', [TaskController::class, 'index'])->name('api.tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->middleware('throttle:tasks')->name('api.tasks.store');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('api.tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('api.tasks.destroy');
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('api.tasks.updateStatus');
});