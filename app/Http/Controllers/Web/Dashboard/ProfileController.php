<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


        return view('dashboard.profile.profile', compact('user'));
    }


    public function update(Request $request)
    {

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'number' => 'nullable|string|max:20', // match your User model
        ]);

        // dd($request);


        // Get user ID from session
        $userId = Session::get('user_id');

        // Find the user in the database
        $user = User::find($userId);

        if (!$user) {
            return redirect()->back()->with('fail', 'User not found.');
        }

        // Update user data
        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->number = $request->number; // note: using 'number' not 'phone'

        $user->save(); // Save changes to database

        // Update session values
        session([
            'user_name'   => $user->name,
            'user_email'  => $user->email,
            'user_number' => $user->number,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }
    public function showChangePassword()
    {
        return view('dashboard.profile.change-password');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:6|confirmed',
        ]);

        // $user = auth()->user(); // get logged-in user

        // // Check current password
        // if (!Hash::check($request->current_password, $user->password)) {
        //     return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        // }

        // // Update password
        // $user->password = Hash::make($request->new_password);
        // $user->save();

        return back()->with('success', 'Password changed successfully!');
    }
}
