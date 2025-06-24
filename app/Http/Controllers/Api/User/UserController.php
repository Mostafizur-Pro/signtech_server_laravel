<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'User retrieved successfully',
            'data' => User::all(),
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => "User not found"
            ], 404);
        }
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            // 'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id,
            'number' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:6',
            'status' => 'nullable|in:active,inactive,delete',
            'role' => 'nullable|in:user,admin,super_admin',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        dd($validated);

        if ($request->hasFile('image')) {

            // Store new image
            $imagePath = $request->file('image')->store('users', 'public');
            $validated['image'] = $imagePath;
        }

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }


        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user,
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }
}
