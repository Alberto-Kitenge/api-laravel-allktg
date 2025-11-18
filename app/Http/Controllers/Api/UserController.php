<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        try {
            $user = User::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => "Utilisateur enregistré avec succès",
                'data' => $user
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'status_code' => 500,
                'status_message' => "Erreur lors de l'enregistrement de l'utilisateur",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(LoginUserRequest $request)
    {
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'status_code' => 401,
                    'status_message' => "Mot de passe incorrect",
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'status_code' => 401,
                    'status_message' => "Utilisateur non trouvé",
                ], 401);
            }

            $expires_at = now()->addDays(1);

            $token = $user->createToken('Personal Access Token', ['*'], $expires_at)->plainTextToken;

            return response()->json([
                'status_code' => 200,
                'status_message' => "Utilisateur connecté avec succès",
                'data' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => $expires_at
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'status_code' => 500,
                'status_message' => "Erreur lors de la connexion de l'utilisateur",
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
