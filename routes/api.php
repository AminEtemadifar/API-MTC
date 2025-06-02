<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json('connection successful');
});
Route::post('/login', [App\Http\Controllers\AuthController::class, 'store']);
Route::middleware(['auth:student'])->get('/logout', [App\Http\Controllers\AuthController::class, 'destroy']);
