<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['user' => auth()->user(), 'token' => $token]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'username'  => 'required|unique:users',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed|min:6',
        ], [
            'name.required' => 'The name field is required.',
            'username.required' => 'The username field is required.',
            'usernmae.unique' => 'The usernmae has already been taken.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        } else {
            $user = new User([
                'name'      => $request->name,
                'username'  => $request->username,
                'email'     => $request->email,
                'password'  => $request->password,
                'created_at'=> now()->format('Y-m-d h:i:s')
            ]);

            $user->save();

            if (isset($request->role)) {
                $user->assignRole($request->role);
            }

            $token = JWTAuth::fromUser($user);

            return response()->json(['message' => 'User registered successfully', 'data' => $user, 'token' => $token], 201);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->header('Authorization');

        if ($token) {
            try {
                JWTAuth::parseToken()->invalidate();
                return response()->json(['message' => 'User logged out successfully']);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Failed to log out'], 500);
            }
        }

        return response()->json(['message' => 'Token not provided'], 400);
    }
}
