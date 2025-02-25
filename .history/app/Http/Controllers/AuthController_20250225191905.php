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
		} catch (\InvalidArgumentException $e) {
			return response()->json(['message' => $e->getMessage()], 400);
		}
    }

    public function login(Request $request) {
        try {

		} catch (\Exception $e) {
			
		}
    }
}
