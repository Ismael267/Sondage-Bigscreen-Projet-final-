<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Méthode pour enregistrer un nouvel utilisateur
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email:filter',
                'password' => 'required|string',
            ]);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return response()->json(['error' => $error, 'status' => 'failed'], 202);
        }

        // Créer un nouvel utilisateur dans la base de données avec le mot de passe hashé
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        // Renvoyer une réponse JSON avec les détails de l'utilisateur nouvellement créé
        return (new UserResource($user))->additional(['error' => "", 'status' => 'done']);
    }

    // Méthode pour gérer la connexion d'un utilisateur
    public function login(Request $request)
    {
        try {
            $request->validate([
                "email" => "required|email:rfc",
                "password" => "required|string",
            ]);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            return response()->json(['error' => $error, 'status' => 'failed'], 202);
        }

        // Rechercher l'utilisateur correspondant à l'e-mail fourni dans la base de données
        $user = User::where(['email' => $request->email])->first();

        if (!$user) {
            return response()->json(['error' => 'impossible de se connecter', 'status' => 'failed'], 202);
        }

        // Vérifier si le mot de passe fourni correspond au mot de passe enregistré dans la base de données
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'mot de passe incorrect', 'status' => 'failed'], 202);
        }

        // Générer un token pour l'utilisateur connecté
        $userToken = $user->createToken("token", ['*'])->plainTextToken;

        // Renvoyer une réponse JSON avec le token de l'utilisateur connecté et un message de succès
        return response()->json(['error' => '', "Token" => $userToken, "Message" => "Connecté avec succès", 'status' => 'done'], 200);
    }

    // Méthode pour gérer la déconnexion d'un utilisateur (révocation du token)
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Vous avez été déconnecté avec succès.'
        ]);
    }
}
