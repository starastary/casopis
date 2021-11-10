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

        return view('dashboard.home')->with('posts', $posts)->with('page', 'home');
    }

    public function magazine()
    {
        return view('dashboard.magazine')->with('page', 'magazine');
    }

    public function users()
    {
        return view('dashboard.users')->with('page', 'users');
    }

    public function settings()
    {
        return view('dashboard.settings')->with('page', 'settings');
    }

}
