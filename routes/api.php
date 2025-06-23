<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Categories\CategoriesController;
use App\Http\Controllers\Api\ContactMessage\ContactMessageController;
use App\Http\Controllers\Api\Gallery\GalleryController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\VRFProject\VRFProjectController;
use Illuminate\Support\Facades\Route;


Route::post('/v1/register', [AuthController::class, 'register']);
Route::post('/v1/auth/logout', [AuthController::class, 'logout'])->middleware('auth:api');


Route::post('/v1/auth/login', [AuthController::class, 'login']);
// Route::get('/v1/auth/user', [AuthController::class, 'me'])->middleware('auth:api');
Route::get('/v1/auth/user', [AuthController::class, 'profile'])->middleware('auth:api');

Route::prefix('/v1/user')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/{id}', [AuthController::class, 'show']);
    Route::delete('/{id}', [AuthController::class, 'destroy']);
    Route::put('/{id}', [AuthController::class, 'update']);
});


Route::get('/v1/user', [UserController::class, 'index']);
Route::get('/v1/user/{id}', [UserController::class, 'show']);
Route::delete('/v1/user/{id}', [UserController::class, 'destroy']);
Route::put('/v1/user/{id}', [UserController::class, 'update']);


// Gallery 

Route::get('/v1/gallery', [GalleryController::class, 'index']);
Route::post('/v1/gallery', [GalleryController::class, 'store']);
Route::get('/v1/gallery/{id}', [GalleryController::class, 'show']);
Route::delete('/v1/gallery/{id}', [GalleryController::class, 'destroy']);
Route::put('/v1/gallery/{id}', [GalleryController::class, 'update']);

// VRF Project

Route::get('/v1/vrf-project', [VRFProjectController::class, 'index']);
Route::post('/v1/vrf-project', [VRFProjectController::class, 'store']);
Route::delete('/v1/vrf-project/{id}', [VRFProjectController::class, 'destroy']);


// Contact Message

Route::get('/v1/contact-message', [ContactMessageController::class, 'index']);
Route::post('/v1/contact-message', [ContactMessageController::class, 'store']);
Route::delete('/v1/contact-message/{id}', [ContactMessageController::class, 'destroy']);

// Categories

Route::get('/v1/categories', [CategoriesController::class, 'index']);
Route::post('/v1/categories', [CategoriesController::class, 'store']);
Route::delete('/v1/categories/{id}', [CategoriesController::class, 'destroy']);


// Product
Route::prefix('/v1/products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});


/*
CAC
Wind-free
4-way
cooling only
r-410A
inverter
indoor unit

selling price: 96000
regular price : 102500
size: 2.0 tr

image max 5 nos



*/