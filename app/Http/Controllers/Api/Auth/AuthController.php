<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request  $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|number|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'nullable|in:user,admin,super_admin',
            'email_verified_at' => 'nullable|date',
        ]);

        dd($data);
    }
}
