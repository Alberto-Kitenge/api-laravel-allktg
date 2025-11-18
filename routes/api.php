<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Il s'agit de créer des liens qui permettront aux clients (React, Vue, Angular, React Native, etc.)
// de faire des requêtes GET, POST, PUT, DELETE

// Récupérer la liste des posts
Route::get('posts', [PostController::class, 'index']);

// Supprimer un post
Route::delete('posts/delete/{post}', [PostController::class, 'destroy']);

// Inscrire un nouvel utilisateur
Route::post('register', [UserController::class, 'register']);

// Se connecter
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Retourner l'utilisateur actuellement connecté
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    // Créer un post
    Route::post('posts/create', [PostController::class, 'store']);

    // Editer un post
    Route::put('posts/edit/{post}', [PostController::class, 'update']);
});
