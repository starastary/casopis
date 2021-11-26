<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use App\Models\Post;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $posts = Post::orderBy('updated_at', 'desc')->where('published_at', '!=', null)->paginate(3);

        $magazines = Magazine::orderBy('updated_at', 'desc')->paginate(3);

        foreach ($posts as $post) {
            $post->authors;
            $post->tags;
        }

        $magazine = Magazine::orderBy('updated_at', 'desc')->first();

        return view('page.home')
            ->with('posts', $posts)
            ->with('magazine', $magazine)
            ->with('magazines', $magazines)
            ->with('page', 'home');
    }

    public function news()
    {

        $posts = Post::orderBy('updated_at', 'desc')->where('published_at', '!=', null)->paginate(12);

        foreach ($posts as $post) {
            $post->authors;
            $post->tags;
        }


        return view('page.news')->with('page', 'news')->with('posts', $posts);
    }

    public function magazine()
    {
        $magazines = Magazine::orderBy('updated_at', 'desc')->paginate(12);
        return view('page.magazine')->with('page', 'magazine')->with('magazines', $magazines);
    }

    public function contact()
    {
        $redaktors = User::where('permission', '>', '0')->orderBy('permission', 'desc')->get();
        return view('page.contact')->with('page', 'contact')->with('redaktors', $redaktors);
    }
}
