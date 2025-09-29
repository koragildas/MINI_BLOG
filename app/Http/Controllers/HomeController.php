<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::latest()->take(6)
            ->withCount('likers')
            ->withCount('comments')
            ->when(Auth::check(), function ($query) {
                $query->withExists(['likers as is_liked' => function ($query) {
                    $query->where('user_id', Auth::id());
                }]);
            })
            ->get(); // Get the 6 latest posts
        return view('home', ['posts' => $posts]);
    }
}
