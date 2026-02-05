<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class DashboardController extends Controller
{
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
    public function profile()
    {
        if (!Session::has('user_id')) {
            return redirect('/login')->with('fail', 'You must log in first.');
        }

        $user = [
            'name' => Session::get('user_name'),
            'email' => Session::get('user_email'),
        ];

        return view('dashboard/profile', compact('user'));
    }
}
