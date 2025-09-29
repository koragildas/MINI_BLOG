<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Lister tous les posts
     */
    public function index(Request $request): JsonResponse
    {
        $query = Post::query();

        // Filtres
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        // Tri
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $perPage = $request->get('per_page', 10);
        $posts = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $posts,
            'message' => 'Posts récupérés avec succès'
        ]);
    }

    /**
     * Créer un nouveau post
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
            'status' => 'in:draft,published',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreurs de validation',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // Gérer l'upload d'image
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')
                ->store('posts/images', 'public');
        }

        $post = Post::create($data);

        return response()->json([
            'success' => true,
            'data' => $post,
            'message' => 'Post créé avec succès'
        ], 201);
    }

    /**
     * Afficher un post spécifique
     */
    public function show(Post $post): JsonResponse
    {
        // Incrémenter les vues
        $post->increment('views');

        return response()->json([
            'success' => true,
            'data' => $post,
            'message' => 'Post récupéré avec succès'
        ]);
    }

    /**
     * Mettre à jour un post
     */
    public function update(Request $request, Post $post): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'author' => 'nullable|string|max:255',
            'status' => 'in:draft,published',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreurs de validation',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // Gérer l'upload d'image
        if ($request->hasFile('featured_image')) {
            // Supprimer l'ancienne image
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }

            $data['featured_image'] = $request->file('featured_image')
                ->store('posts/images', 'public');
        }

        $post->update($data);

        return response()->json([
            'success' => true,
            'data' => $post->fresh(),
            'message' => 'Post mis à jour avec succès'
        ]);
    }

    /**
     * Supprimer un post
     */
    public function destroy(Post $post): JsonResponse
    {
        // Supprimer l'image associée
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post supprimé avec succès'
        ]);
    }

    /**
     * Rechercher des posts
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Paramètre de recherche requis'
            ], 400);
        }

        $posts = Post::published()
            ->where(function($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('content', 'LIKE', "%{$query}%")
                  ->orWhereJsonContains('tags', $query);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $posts,
            'message' => 'Résultats de recherche'
        ]);
    }
}
