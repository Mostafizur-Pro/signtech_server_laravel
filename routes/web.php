<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Auth/login');
});
Route::get('/register', function () {
    return view('Auth/register');
});
