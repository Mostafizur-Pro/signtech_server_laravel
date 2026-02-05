<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class ProfileController extends Controller
{
    public function profile()
    {
        if (!Session::has('user_id')) {
            return redirect('/login')->with('fail', 'You must log in first.');
        }

        $user = [
            'name' => Session::get('user_name'),
            'email' => Session::get('user_email'),
            'number' => Session::get('user_number'),
        ];

        // $user = auth()->user();

        // dd($user);


        return view('dashboard/profile', compact('user'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
        ]);

        // Update session values
        session([
            'user_name' => $request->name,
            'user_email' => $request->email,
            'user_number' => $request->phone,
        ]);
        dd($user);

        return back()->with('success', 'Profile updated successfully.');
    }
}
