<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $posts = Post::paginate(20);
        foreach ($posts as $post) {
            $post->authors;
            $post->tags;
        }

        return view('dashboard.home')->with('posts', $posts);
    }
}
