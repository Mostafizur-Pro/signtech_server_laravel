<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::all(); // Get all users
        // dd($users);
        $roles = ['admin', 'manager', 'user']; // Predefined roles
        return view('dashboard.settings.user-role', compact('users', 'roles'));
    }

    // Update user rol
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string|in:admin,manager,user',
        ]);

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'User role updated successfully!');
    }
}
