<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{

    private static function responseWithToken(User $user, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        // Elimina los token anteriores
        $user->tokens()->delete();

        // Registra un nuevo token
        $token = $user->createToken("api")->plainTextToken;

        return response()->json([
            "success" => true,
            "user" => $user,
            "token" => $token,
        ], $statusCode);
    }

    public function createAccount(Request $request): JsonResponse
    {
        $fields = $request->validate([
            "email" => "required|email|unique:users|max:255",
            "name" => "required|min:2|max:100",
            "password" => "required|min:8|max:20"
        ]);

        $user = User::create($fields);

        return self::responseWithToken($user, Response::HTTP_CREATED);
    }

    public function updateAccount(Request $request): JsonResponse
    {
        $user = $request->user();
        $fields = $request->validate([
            "email" => "nullable|email|unique:users,email,{$user->id}|max:255",
            "name" => "nullable|min:2|max:100",
        ]);

        $cleanFields = [];

        foreach ($fields as $key => $value)
            if ($value) $cleanFields[$key] = $value;

        if (count($cleanFields) <= 0) return response()->json([
            "message" => "Sin campos para actualizar"
        ], 400);


        $user->update($cleanFields);

        return response()->json(["success" => true]);
    }

    public function login(Request $request): JsonResponse
    {
        $credentials =  $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if (auth()->attempt($credentials))
            return self::responseWithToken(auth()->user(), Response::HTTP_CREATED);

        return response()->json([
            "success" => false
        ], 401);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json([
            "success" => true
        ]);
    }

    public function me(): JsonResponse
    {
        return response()->json([
            "user" => auth()->user()
        ]);
    }
}
