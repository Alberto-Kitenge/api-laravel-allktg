<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Post::query();
            $perPage = 10;

            $page = $request->input('page', 1);
            $search = $request->input('search', '');

            if ($search) {
                $searchItem = "%{$search}%";
                $query->where(function ($q) use ($searchItem) {
                    $q->where('title', 'LIKE', $searchItem)
                        ->orWhere('description', 'LIKE', $searchItem);
                });
            }

            $total = $query->count();
            $result = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();

            if ($total === 0) {
                return response()->json([
                    'status_code' => 404,
                    'status_message' => "Aucun post trouvé"
                ], 404);
            }

            $lastPage = ceil($total / $perPage);

            if ($page > $lastPage) {
                return response()->json([
                    'status_code' => 404,
                    'status_message' => "Page non trouvée"
                ], 404);
            }

            return response()->json([
                'status_code' => 200,
                'status_message' => "Les posts ont été récupérés",
                'current_page' => $page,
                'last_page' => $lastPage,
                'total' => $total,
                'data' => $result
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status_message' => "Erreur lors de la récupération des posts",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(CreatePostRequest $request)
    {
        try {
            $post = Post::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => "Post ajouté avec succès",
                'data' => $post
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'status_code' => 500,
                'status_message' => "Erreur lors de l'ajout du post",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(EditPostRequest $request, Post $post)
    {
        try {
            $post->update($request->validated());

            return response()->json([
                'status_code' => 200,
                'status_message' => "Post modifié avec succès",
                'data' => $post
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'status_code' => 500,
                'status_message' => "Erreur lors de la modification du post",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Post::find($id);

            if ($post) {
                $post->delete();

                return response()->json([
                    'status_code' => 200,
                    'status_message' => "Post supprimé avec succès",
                    'data' => $post
                ], 200);
            } else {
                return response()->json([
                    'status_code' => 404,
                    'status_message' => "Post non trouvé"
                ], 404);
            }
        } catch (Exception $e) {

            return response()->json([
                'status_code' => 500,
                'status_message' => "Erreur lors de la suppression du post",
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
