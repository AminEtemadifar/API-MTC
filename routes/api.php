<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonTypeController;
use App\Http\Controllers\RankController;
use Illuminate\Support\Facades\Route;

// Test connection route
Route::get('/', function () {
    return response()->json('connection successful');
});

// Auth routes
Route::post('/login', [AuthController::class, 'store']);
Route::middleware(['auth:student'])->get('/logout', [AuthController::class, 'destroy']);

// Branch routes
Route::apiResource('branches', BranchController::class)->only('index');

// Lesson routes
Route::apiResource('lessons', LessonController::class)->only('index');

// Lesson Type routes
Route::apiResource('lesson-types', LessonTypeController::class)->only('index');

// Rank routes
Route::apiResource('ranks', RankController::class)->only('index');
