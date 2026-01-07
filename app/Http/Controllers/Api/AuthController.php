<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validator = \Validator::make($request->input(), User::$rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()->all(),
            ], 400);
        }
        //alta del usuario
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'Data' => $user,
            'status' => Response::HTTP_CREATED,
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->status == 1) {
                $token = $user->createToken('token')->plainTextToken;
                $cookie = cookie('cookie_token', $token, 60 * 24);
                return response()->json([
                    "status" => true,
                    "data" => $user,
                    "token" => $token,
                ], Response::HTTP_OK)->withoutCookie($cookie);
            } else {
                return response(["message" => "Usuario no autorizado"], Response::HTTP_UNAUTHORIZED);
            }

        } else {
            return response(["message" => "Credenciales inválidas"], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function validateToken(Request $request): JsonResponse
    {
        try {
            // El middleware de Sanctum ya valida el token
            // Si llegamos aquí, el token es válido
            $user = auth()->user();
            
        return response()->json([
            'valid' => true,
            'user_id' => $user->id,
            'email' => $user->email,
        ], Response::HTTP_OK);
    } catch (\Exception $e) {
        auth()->user()->tokens()->delete();
        return response()->json([
            'valid' => false,
            'message' => 'Token inválido o expirado'
        ], Response::HTTP_UNAUTHORIZED);
    }
}

    public function userProfile()
    {
        return response()->json([
            "message" => "userProfile OK",
            "userData" => auth()->user(),
        ], Response::HTTP_OK);
    }

    public function logout()
    {
        $cookie = Cookie::forget('cookie_token');
        auth()->user()->tokens()->delete();
        return response(["message" => "Cierre de sesión OK"], Response::HTTP_OK)->withCookie($cookie);
    }

}
