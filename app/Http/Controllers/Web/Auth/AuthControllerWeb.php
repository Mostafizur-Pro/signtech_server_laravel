<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthControllerWeb extends Controller
{

   public function index()
    {
        return view('Auth.login');
    }

    // Show registration page
    public function registerForm()
    {
        return view('Auth.register');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Store user session
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->name);
            Session::put('user_email', $user->email);

            return redirect('/dashboard')->with('success', 'Login Successful!');
        } else {
            return back()->with('fail', 'Invalid login credentials!');
        }
    }

    // Handle logout
    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }

    // Dashboard
    public function dashboard()
    {
        if (!Session::has('user_id')) {
            return redirect('/login')->with('fail', 'You must log in first.');
        }

        $user = [
            'name' => Session::get('user_name'),
            'email' => Session::get('user_email'),
        ];

        return view('dashboard/dashboard', compact('user'));
    }




   
}
