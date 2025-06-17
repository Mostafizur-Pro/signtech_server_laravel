<?php


use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('/v1/register', [AuthController::class, 'register']);

Route::get('/v1/user', [AuthController::class, 'index']);
Route::get('/v1/user/{id}', [AuthController::class, 'show']);
Route::delete('/v1/user/{id}', [AuthController::class, 'destroy']);
Route::put('/v1/user/{id}', [AuthController::class, 'update']);
