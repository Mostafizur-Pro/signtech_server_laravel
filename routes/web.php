<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\AuthControllerWeb;

// Route::get('/', function () {
//     return view('Auth/login');
// });
Route::get('/register', function () {
    return view('Auth/register');
});
Route::get('/dashboard', function () {
    return view('dashboard/dashboard');
})->middleware('auth');



Route::get('/', [AuthControllerWeb::class, 'index']);
Route::post('/login', [AuthControllerWeb::class, 'login']);
Route::post('/logout', [AuthControllerWeb::class, 'logout'])->name('logout');