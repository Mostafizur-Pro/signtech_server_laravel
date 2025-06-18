<?php


use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Gallery\GalleryController;
use App\Http\Controllers\Api\VRFProject\VRFProjectController;
use Illuminate\Support\Facades\Route;


Route::post('/v1/register', [AuthController::class, 'register']);

Route::get('/v1/user', [AuthController::class, 'index']);
Route::get('/v1/user/{id}', [AuthController::class, 'show']);
Route::delete('/v1/user/{id}', [AuthController::class, 'destroy']);
Route::put('/v1/user/{id}', [AuthController::class, 'update']);

Route::get('/v1/gallery', [GalleryController::class, 'index']);
Route::post('/v1/gallery', [GalleryController::class, 'store']);
Route::delete('/v1/gallery/{id}', [GalleryController::class, 'destroy']);

Route::get('/v1/vrf-project', [VRFProjectController::class, 'index']);
Route::post('/v1/vrf-project', [VRFProjectController::class, 'store']);
Route::delete('/v1/vrf-project/{id}', [VRFProjectController::class, 'destroy']);
