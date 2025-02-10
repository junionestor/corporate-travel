<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email|email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (! $user || ! Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Credenciais inválidas',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken('token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response([
            'message' => 'Deslogado',
        ], Response::HTTP_OK);
    }
}
