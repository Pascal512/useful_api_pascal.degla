<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleController;
use App\Http\Middleware\CheckModuleActive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentification
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Module
Route::get('/modules', [ModuleController::class, 'index'])->middleware('auth:sanctum');
Route::post('/modules/{id}/activate', [ModuleController::class, 'activate'])->middleware('auth:sanctum');
Route::post('/modules/{id}/deactivate', [ModuleController::class, 'deactivate'])->middleware('auth:sanctum');

Route::group(['middleware' => ["auth:sanctum", CheckModuleActive::class.':1']], function () {
    Route::post('/shorten', );
    Route::get('/s/{code}', );
    Route::get('/links', );
    Route::delete('/links/{id}', );
});

Route::group(['middleware' => ["auth:sanctum", CheckModuleActive::class.':2']], function () {
    //
});

Route::group(['middleware' => ["auth:sanctum", CheckModuleActive::class.':3']], function () {
    //
});

Route::group(['middleware' => ["auth:sanctum", CheckModuleActive::class.':4']], function () {
    //
});

Route::group(['middleware' => ["auth:sanctum", CheckModuleActive::class.':5']], function () {
    //
});
