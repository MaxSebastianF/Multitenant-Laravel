<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }

        return $this->respondWithToken($token);
    }

public function me()
{
    $user = auth()->user()->load(['roles', 'permissions', 'client']);

    return response()->json([
        'id_user' => $user->id_user,
        'name' => $user->name,
        'lastname' => $user->lastname,
        'email' => $user->email,
        'username' => $user->username,
        'status' => $user->status,
        'roles' => $user->getRoleNames(),
        'permissions' => $user->getAllPermissions()->pluck('name'),
        'client' => $user->client,
    ]);
}




    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
            'user'         => auth()->user(),
        ]);
    }
}
