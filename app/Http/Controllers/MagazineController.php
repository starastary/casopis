<?php

namespace App\Http\Controllers;

use App\Models\Img;
use App\Models\Magazine;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MagazineController extends Controller
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

        return view('magazine.create');
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
            "file" => "required|mimes:pdf",
            "motto" => "string|nullable",
            "text" => "string|nullable",
        ]);



        if ($request->file('img')) {
            $file = Str::slug(explode('.',$request->file('img')->getClientOriginalName())[0]);
            $type = explode('.',$request->file('img')->getClientOriginalName())[1];
            $fileName = $file . '.' . $type;

            $path=$request->file('img')->storeAs('imgs', $fileName, 'public');

            $img_url = '/uploads/'.$path;

            if (!Img::where('name', $fileName)->first()) {
                Img::create([
                    "name" => $fileName,
                    "path" => $img_url,
                ]);
            }
        } else {
            $img_url = "";
        }

        if ($request->file('file')) {
            $file = Str::slug(explode('.',$request->file('file')->getClientOriginalName())[0]);
            $type = explode('.',$request->file('file')->getClientOriginalName())[1];
            $fileName = $file . '.' . $type;

            $path=$request->file('file')->storeAs('magazines', $fileName, 'public');

            $file_url = '/uploads/'.$path;

        }

        $authors = [];
        $redaktors = User::where('role','Redaktor')->get();
        foreach ($redaktors as $redaktor){
            array_push($authors, $redaktor->id);
        }

        $magazine = Magazine::create([
            "name" => $request->name,
            "motto" => $request->motto,
            "authors" => json_encode($authors),
            "img" => $img_url,
            "file" => $file_url,
            "editor" => User::where('role','Editor')->first()->id,
            "chief" => User::where('role','Chief')->first()->id
        ]);

        return redirect('/dashboard/magazine');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function show($id)
    {
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
            abort(403, "Nedostatečná práva");
        }

        $magazine = Magazine::find($id);

        if (!$magazine) {
            abort(404, "Časopis nenalezen");
        }


        return view('magazine.edit')->with('magazine', $magazine);
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
            abort(403, "Nedostatečná práva");
        }

        $magazine = Magazine::find($id);

        if (!$magazine) {
            abort(404, "Časopis nenalezen");
        }

        $this->validate($request,[
            "name" => "required|string|max:255|unique:posts",
            "img" => "mimes:jpg,png",
            "file" => "mimes:pdf",
            "motto" => "string|nullable",
            "text" => "string|nullable",
        ]);



        if ($request->file('img')) {
            $file = Str::slug(explode('.',$request->file('img')->getClientOriginalName())[0]);
            $type = explode('.',$request->file('img')->getClientOriginalName())[1];
            $fileName = $file . '.' . $type;

            $path=$request->file('img')->storeAs('imgs', $fileName, 'public');

            $img_url = '/uploads/'.$path;

            if (!Img::where('name', $fileName)->first()) {
                Img::create([
                    "name" => $fileName,
                    "path" => $img_url,
                ]);
            }

            $magazine->img = $img_url;
        } else {
            $img_url = "";
        }

        if ($request->file('file')) {
            $file = Str::slug(explode('.',$request->file('file')->getClientOriginalName())[0]);
            $type = explode('.',$request->file('file')->getClientOriginalName())[1];
            $fileName = $file . '.' . $type;

            $path=$request->file('file')->storeAs('magazines', $fileName, 'public');

            $file_url = '/uploads/'.$path;
            $magazine->file = $file_url;
        }


        $magazine->name = $request->name;
        $magazine->motto = $request->motto;
        $magazine->save();

        return redirect('/dashboard/magazine');
    }

    public function delete($id)
    {
        if (Auth::user()->permission < 1) {
            abort(403, "Nedostatečná práva");
        }

        $magazine = Magazine::find($id);

        if (!$magazine) {
            abort(404, "Časopis nenalezen");
        }

        $magazine->delete();

        return redirect('/dashboard/magazine');
    }
}
