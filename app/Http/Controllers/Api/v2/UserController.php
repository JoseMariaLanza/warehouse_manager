<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return response()->json([
            "status" => 'OK',
            "message" => 'Usuario creado con exito',
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (isset($user->id)) {
            if (Hash::check($request->password, $user->password)) {
                // Creacion del token
                $token = $user->createToken("auth_token")->plainTextToken;

                // si esta ok
                return response()->json([
                    'status' => 'OK',
                    'message' => 'Usuario logueado exitosamente',
                    'access_token' => $token,
                    'role' => 'nombre rol',
                    'permissions' => 'array de permisos'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'FAIL',
                    'message' => 'La contraseña es incorrecta'
                ], 404);
            }
        } else {
            return response()->json([
                'status' => 'FAIL',
                'message' => 'Usuario no registrado'
            ], 404);
        }
    }

    function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            "status" => 'OK',
            "message" => 'Usuario deslogueado con exito',
        ]);
    }
}
