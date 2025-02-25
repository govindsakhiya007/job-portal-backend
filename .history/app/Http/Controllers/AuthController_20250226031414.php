<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request) {
        try {
			$inputs = $request->validate([
				'name' => 'required|string',
				'email' => 'required|email|unique:users',
				'password' => 'required|min:6',
				'role' => 'required|in:employer,applicant',
			]);

			$inputs['password'] = bcrypt($inputs['password']);
			$user = User::create($inputs);

			return response()->json([
				'message' => 'Registration successfully.',
				'token' => $user->createToken('token')->plainTextToken],
				200);
		} catch (\Exception $e) {
			return response()->json([
                'message' => $e->getMessage()
            ], 500);
		}
    }

    public function login(Request $request) {
        try {
			$request->validate([
				'email' => 'required|email',
				'password' => 'required',
			]);

			if (!Auth::attempt($request->only('email', 'password'))) {
				return response()->json([
					'message' => $e->getMessage()
				], 500);
			}

			return response()->json([
				'message' => 'Logged in successfully.',
				'token' => Auth::user()->createToken('token')->plainTextToken],
				'role' =>Auth::user()->role
				200);
		} catch (\Exception $e) {
			return response()->json(['message' => 'Invalid credentials'], 401);
		}
    }

	public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->tokens()->delete();
        }

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }
}
