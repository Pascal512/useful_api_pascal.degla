<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
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
        //
    }
}
