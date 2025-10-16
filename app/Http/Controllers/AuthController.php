<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email|max:255',
            'password' => 'required|min:8',
            'name' => 'required|max:255',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => $request->password,
            'name' => $request->name,
        ]);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email|max:255',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => "Unauthorized, wrong credentials",
            ], 401);
        }

        $token = $user->createToken($user->name);

        return response()->json([
            'token' => $token->plainTextToken,
            'user_id' => $user->id,
        ], 200);
    }
}
