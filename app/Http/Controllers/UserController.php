<?php

namespace App\Http\Controllers;

use App\Models\Img;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function edit($id)
    {
        if (Auth::user()->permission < 5) {
            abort(403, "Nedostatečná práva");
        }

        $user = User::find($id);

        if (!$user) {
            abort(404,'Uživatel nenalezen');
        }
        return view('dashboard.users.edit')->with('user', $user)->with('roles', Role::all());
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->permission < 5) {
            abort(403, "Nedostatečná práva");
        }

        $user = User::find($id);

        if (!$user) {
            abort(404,'Uživatel nenalezen');
        }

        $this->validate($request,[
            "name" => "required|string|max:255",
            "nickname" => "string|max:255|nullable",
            "email" => "required|string|max:255",
            "motto" => "string|nullable",
            "role" => "required|string|max:255",
            "avatar" => "mimes:jpg,png",
        ]);

        if ($request->file('avatar')) {
            $file = Str::slug(explode('.',$request->file('avatar')->getClientOriginalName())[0]);
            $type = explode('.',$request->file('avatar')->getClientOriginalName())[1];
            $fileName = $file . '.' . $type;

            $path=$request->file('avatar')->storeAs('avatars', $fileName, 'public');
            $url = '/uploads/'.$path;
            if (!Img::where('name', $fileName)->first()) {
                Img::create([
                    "name" => $fileName,
                    "path" => $url,
                ]);
            }
            $user->avatar = $url;
        }

        $user->name = $request->name;
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->motto = $request->motto;
        $role = Role::find($request->role);
        $user->role = $role->name;
        $user->permission = $role->permission;
        $user->save();

        return redirect('/dashboard/users');
    }
}
