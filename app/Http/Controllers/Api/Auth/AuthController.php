<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }
        return response()->json([
            'token' => $token,
            'user' => auth('api')->user(),
        ]);
    }



    public function me($request)
    {
        $token = $request->bearerToken();
        $user = auth('api')->user();
        return response()->json([
            'token_used' => $token,
            'user' => $user,
        ]);
    }
    public function profile(Request $request)
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        return response()->json([
            'token_used' => $request->bearerToken(),
            'user' => $user,
        ]);
    }

    public function logout()
    {
        dd("dat");
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
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
}
