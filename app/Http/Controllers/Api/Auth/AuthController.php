<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {


        return response()->json([
            'success' => true,
            'message' => 'User retrieved successfully',
            'data' => User::all(),
        ], 200);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'nullable|in:user,admin,super_admin',
            'status' => 'nullable|in:active,inactive,delete',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/users');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);
            $data['image'] = url('uploads/users/' . $imageName);
        }

        // Hash the password
        $data['password'] = bcrypt($data['password']);

        // Create user
        $user = User::create($data);

        // Create token
        // $token = $user->createToken($data['name']);

        return response()->json([
            "success" => true,
            "message" => "User registered successfully",
            "data" => $user,
            // "token" => $token->plainTextToken
        ], 201);
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

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/users');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
            $validated['image'] = url('uploads/users/' . $imageName);
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
