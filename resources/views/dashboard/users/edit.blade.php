@extends('layout')

@section('title', 'Upravit příspěvek')

@section('content')
    <script src="https://cdn.tiny.cloud/1/bys1ly30gpwdd8jb5i9lt4ro2avsfnxmn1em00cbt3baqbun/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <div class="" style="display: grid; place-content: center;width: 100%; min-height: 100vh">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('dashboard.users.update', $user->id)}}" class="w-screen" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-3">

                <div class="p-3 flex flex-col md:flex-row">
                    <!-- Jméno -->
                    <div class="flex flex-col lg:flex-row w-full items-center justify-between lg:mt-8 m-2">
                        <div class="flex flex-col justify-start mx-6 w-full  mt-2">
                            <label for="name" class="text-2xl mb-2">Jméno:</label>
                            <input id="name" value="{{old('name') ?:$user->name}}" class="rounded-lg px-5 py-3 text-lg border border-primary-700" type="text" name="name" required autofocus />
                        </div>
                    </div>

                    <!-- Přezdívka -->
                    <div class="flex flex-col lg:flex-row w-full items-center justify-between lg:mt-8 m-2">
                        <div class="flex flex-col justify-start mx-6 w-full  mt-2">
                            <label for="nickname" class="text-2xl mb-2">Přezdívka:</label>
                            <input id="nickname" value="{{old('nickname') ?:$user->nickname}}" class="rounded-lg px-5 py-3 text-lg border border-primary-700" type="text" name="nickname"/>
                        </div>
                    </div>


                </div>
                <div class="p-3 flex flex-col md:flex-row md:items-center">
                    <!-- Email -->
                    <div class="flex flex-col lg:flex-row w-full items-center justify-between lg:mt-8 m-2">
                        <div class="flex flex-col justify-start mx-6 w-full  mt-2">
                            <label for="email" class="text-2xl mb-2">Email:</label>
                            <input id="email" value="{{old('email') ?:$user->email}}" class="rounded-lg px-5 py-3 text-lg border border-primary-700" type="email" name="email" required />
                        </div>
                    </div>
                    <!-- Profilovka -->
                    <div class="flex flex-col lg:flex-row w-full items-center justify-between lg:mt-8 m-2">
                        <div class="flex flex-col justify-start mx-6 w-full  mt-2">
                            <label for="img" class="text-2xl mb-2">Profilovka:</label>
                            <input type="file" id="img" name="avatar" value="{{old('avatar') ?:$user->avatar}}"
                                   accept=".png,.jpg">
                        </div>
                    </div>
                </div>

                <div class="p-3 flex flex-col md:flex-row md:items-center">
                    <!-- Motto -->
                    <div class="flex flex-col lg:flex-row w-full items-center justify-between lg:mt-8 m-2">
                        <div class="flex flex-col justify-start mx-6 w-full  mt-2">
                            <label for="motto" class="text-2xl mb-2">Motto:</label>
                            <input id="motto" class="rounded-lg px-5 py-3 text-lg border border-primary-700" type="text" name="motto" value="{{old('motto') ?:$user->motto}}" />
                        </div>
                    </div>

                    <!-- Role -->
                    <div class="flex flex-col lg:flex-row w-full items-center justify-between lg:mt-8 m-2">
                        <div class="flex flex-col justify-start mx-6 w-full  mt-2">
                            <label for="role" class="text-2xl mb-2">Role:</label>
                            <select name="role" id="role" required class="rounded-lg px-5 py-3 text-lg border border-primary-700 bg-white">
                                @foreach($roles as $role)
                                    @if ($user->role == $role->name)
                                        <option value="{{$role->id}}" selected>{{$role->name}} ({{$role->permission}})</option>
                                    @else
                                        <option value="{{$role->id}}">{{$role->name}} ({{$role->permission}})</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>




            </div>

            <button type="submit" class="block m-auto uppercase font-bold text-2xl text-white mt-10 py-4 px-16 bg-blue-500 rounded-lg shadow-lg hover:shadow-2xl hover:bg-blue-600 transition">
                Upravit
            </button>
            <a href="{{route('dashboard.users')}}" class="mt-5 underline text-gray-500 hover:text-gray-700 m-auto block w-max">Zpět</a>
        </form>
    </div>
@endsection
