<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{
    /**
     * Handle the request to like or unlike a post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleLike(Post $post)
    {
        $user = Auth::user();

        // Attach or detach the like for the user
        $user->likes()->toggle($post->id);

        // Reload the post to get the updated like count
        $post->loadCount('likers');

        return response()->json([
            'likes_count' => $post->likers_count,
            'is_liked' => $user->likes()->where('post_id', $post->id)->exists(),
        ]);
    }
}