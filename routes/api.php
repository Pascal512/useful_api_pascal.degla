<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentification
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Module
Route::get('/modules', [ModuleController::class, 'index'])->middleware('auth:sanctum');
Route::post('/modules/{id}/activate', [ModuleController::class, 'activate'])->middleware('auth:sanctum');
Route::post('/modules/{id}/deactivate', [ModuleController::class, 'deactivate'])->middleware('auth:sanctum');

