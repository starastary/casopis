<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $posts = Post::orderBy('updated_at', 'desc')->where('published_at', '!=', null)->paginate(12);

        foreach ($posts as $post) {
            $post->authors;
            $post->tags;
        }

        return view('page.home')->with('posts', $posts);
    }
}
