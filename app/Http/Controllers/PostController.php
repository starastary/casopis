<?php

namespace App\Http\Controllers;

use App\Models\Img;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->permission < 1) {
            return '403';
        }

        return view('post.create')->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if (Auth::user()->permission < 1) {
            return '403';
        }

        $this->validate($request,[
            "name" => "required|string|max:255|unique:posts",
            "img" => "mimes:jpg,png",
            "short" => "string|nullable",
            "text" => "string|nullable",
        ]);



        if ($request->file('img')) {
            $file = Str::slug(explode('.',$request->file('img')->getClientOriginalName())[0]);
            $type = explode('.',$request->file('img')->getClientOriginalName())[1];
            $fileName = $file . '.' . $type;

            $path=$request->file('img')->storeAs('imgs', $fileName, 'public');

            $url = Storage::url($path);

            if (!Img::where('name', $fileName)->first()) {
                Img::create([
                    "name" => $fileName,
                    "path" => $url,
                ]);
            }
        } else {
            $url = "";
        }

        if ($request->completed) {
            $completed = 1;
        } else {
            $completed = 0;
        }

        if ($request->editor_checked) {
            $editor_checked = 1;
        } else {
            $editor_checked = 0;
        }

        if ($request->chief_checked) {
            $chief_checked = 1;
        } else {
            $chief_checked = 0;
        }

        $post = Post::create([
            "name" => $request->name,
            "slug" => Str::slug($request->name),
            "short" => $request->short,
            "img" => $url,
            "text" => $request->text,
            "editor" => '1',
            "chief" => '1',
            "completed" => $completed,
            "editor_checked" => $editor_checked,
            "chief_checked" => $chief_checked,
        ]);

        $author = DB::insert("INSERT INTO `users_posts` (`user_id`, `post_id`) VALUES (?, ?);", [Auth::id(),$post->id]);

        $post->tags()->sync($request->tags);

        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('post.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->permission < 1) {
            return '403';
        }

        if (Auth::user()->permission < 1) {
            return '403';
        }

        $post = Post::find($id);

        $tags = [];

        foreach ($post->tags as $tag) {
            array_push($tags, $tag->id);
        }

        return view('post.edit')->with('post', $post)->with('tags', Tag::all())->with('used_tags', $tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->permission < 1) {
            return '403';
        }

        $this->validate($request,[
            "name" => "required|string|max:255",
            "img" => "mimes:jpg,png",
            "short" => "string|nullable",
            "text" => "string|nullable",

        ]);

        if ($request->file('img')) {
            $file = Str::slug(explode('.',$request->file('img')->getClientOriginalName())[0]);
            $type = explode('.',$request->file('img')->getClientOriginalName())[1];
            $fileName = $file . '.' . $type;

            $path=$request->file('img')->storeAs('imgs', $fileName, 'public');

            $url = Storage::url($path);

            if (!Img::where('name', $fileName)->first()) {
                Img::create([
                    "name" => $fileName,
                    "path" => $url,
                ]);
            }
        } else {
            $url = Post::find($id)->img;
        }

        if ($request->completed) {
            $completed = 1;
        } else {
            $completed = 0;
        }

        if ($request->editor_checked) {
            $editor_checked = 1;
        } else {
            $editor_checked = 0;
        }

        if ($request->chief_checked) {
            $chief_checked = 1;
        } else {
            $chief_checked = 0;
        }

        $post = Post::find($id)->update([
            "name" => $request->name,
            "slug" => Str::slug($request->name),
            "short" => $request->short,
            "img" => $url,
            "text" => $request->text,
            "editor" => '1',
            "chief" => '1',
            "completed" => $completed,
            "editor_checked" => $editor_checked,
            "chief_checked" => $chief_checked,
        ]);

        if (!DB::select('SELECT * FROM `users_posts` WHERE `user_id` = ? AND `post_id` = ?', [Auth::id(),$id])) {
            $author = DB::insert("INSERT INTO `users_posts` (`user_id`, `post_id`) VALUES (?, ?);", [Auth::id(),$post->id]);
        }

        $post = Post::find($id);

        $post->tags()->sync($request->tags);

        $post->save();

        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish($id)
    {
        if (Auth::user()->permission < 1) {
            return '403';
        }

        $post = Post::find($id);

        if ($post->published_at) {
            $post->published_at = null;
        } else {
            if ($post->completed && $post->editor_checked && $post->chief_checked) {
                $post->published_at = date('Y-m-d H:i:s');
            }
        }

        $post->save();

        return redirect('/dashboard');
    }

    public function tag($name)
    {
        if (Auth::user()->permission < 1) {
            return '403';
        }

        if (Tag::where('name', $name)->first()) {
            return 'Tag již existuje';
        }

        $tag = Tag::create(['name' => $name]);
        return $tag;
    }

    public function upload(Request $request){
        if (Auth::user()->permission < 1) {
            return '403';
        }

        $file = Str::slug(explode('.',$request->file('file')->getClientOriginalName())[0]);
        $type = explode('.',$request->file('file')->getClientOriginalName())[1];
        $fileName = $file . '.' . $type;

        $path=$request->file('file')->storeAs('imgs', $fileName, 'public');

        $url = Storage::url($path);

        if (!Img::where('name', $fileName)->first()) {
            Img::create([
                "name" => $fileName,
                "path" => $url,
            ]);
        }

        return response()->json(['location'=>$url]);
    }
}
