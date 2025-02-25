<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request) {
        $inputs = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:employer,applicant',
        ]);

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return response()->json(['message' => 'Registration successfully.', 'token' => $user->createToken('token')->plainTextToken], 200);
    }

    public function login(Request $request) {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json(['message' => 'Logged in successfully.', 'token' => Auth::user()->createToken('token')->plainTextToken], 200);
    }
}
