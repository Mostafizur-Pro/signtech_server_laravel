<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\AuthControllerWeb;
use App\Http\Controllers\Web\Dashboard\DashboardController;
use App\Http\Controllers\Web\QRController;



Route::get('/', [AuthControllerWeb::class, 'index']);
Route::get('/login', [AuthControllerWeb::class, 'index']);
Route::post('/login', [AuthControllerWeb::class, 'login']);

Route::get('/register', [AuthControllerWeb::class, 'registerForm'])->name('register.form');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');


Route::get('/qr-generator', [QRController::class, 'index'])->name('qr.generator');
Route::post('/qr-generator', [QRController::class, 'generate'])->name('qr.generate');

Route::post('/logout', [AuthControllerWeb::class, 'logout'])->name('logout');







// Route::get('/', function () {
//     return view('Auth/login');
// });
// Route::get('/register', function () {
//     return view('Auth/register');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard/dashboard');
// })->middleware('auth');




// Route::post('/logout', [AuthControllerWeb::class, 'logout'])->name('logout');



// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
// Route::post('/register', [AuthController::class, 'register'])->name('register');

// Route::get('/login', [AuthControllerWeb::class, 'showLoginForm'])->name('login.form');
// Route::post('/login', [AuthControllerWeb::class, 'login'])->name('login');

// Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
