<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CacheController;
use App\Http\Controllers\GpuController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::get('/clear-Cache', [CacheController::class, 'clearCache']);

Route::prefix('gpus')->group(function () {
    Route::get('/', [GpuController::class, 'index']);        // ✅ Get all GPUs
    Route::get('/{id}', [GpuController::class, 'show']);      // ✅ Get single GPU
    Route::post('/', [GpuController::class, 'store']);       // ✅ Create new GPU
    Route::put('/{id}', [GpuController::class, 'update']);    // ✅ Update GPU
});