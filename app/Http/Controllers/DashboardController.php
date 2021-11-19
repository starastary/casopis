<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
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
        $users = User::all();
        return view('dashboard.users')->with('page', 'users')->with('users', $users);
    }

    public function settings()
    {
        return view('dashboard.settings')->with('page', 'settings');
    }

}
