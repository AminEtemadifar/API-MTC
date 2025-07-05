<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChartController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\NewsController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/charts', [ChartController::class, 'index']);
Route::get('/lessons', [LessonController::class, 'index']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // News management routes (superadmin only)
    Route::apiResource('news', NewsController::class)->except(['index']);

    Route::apiResource('chats', ChatController::class)->only(['index']);
    Route::apiResource('messages', MessageController::class)->only(['index' , 'store']);

});
