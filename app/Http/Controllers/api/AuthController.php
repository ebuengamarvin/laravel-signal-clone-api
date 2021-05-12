<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\User as UserResource;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)) {
            $user = Auth::user();

            return response()->json([
                'user' => new UserResource($user),
                'token' => $user->createToken('auth_token')->plainTextToken
            ], 200);
        }

        throw new AuthenticationException;
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'device_name' => 'required',
            'image_url' => 'nullable'
        ]);

        $validated['password'] = bcrypt($request->password);

        $user = User::create($validated);


        return response()->json([
            'user' => new UserResource($user),
            'token' => $user->createToken('auth_token')->plainTextToken
        ], 200);
    }

    public function logout(Request $request)
    {
        return $request->user()->tokens()->delete();
    }

    public function user(Request $request)
    {
        return new UserResource($request->user());
    }
}
