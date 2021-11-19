@extends('layout')
@section('title', 'Users - Administrace')

@section('content')
    @include('dashboard.navbar')
    <main class="" style="height: 2000px;">
        <div class="p-2 w-full overflow-auto">
            <table class="table-fixed w-max mx-auto">
                <tr>
                    <th class="border-black border-2 px-2 py-1 text-center">#</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Jméno</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Přezdívka</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Profilovka</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Motto</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Role</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Práva</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Počet článků</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Upravit</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Vytvořeno</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Upraveno</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td class="border-black border px-2 py-1 text-center">{{$user->id}}</td>
                        <td class="border-black border px-2 py-1 text-center">{{$user->name}}</td>
                        <td class="border-black border px-2 py-1 text-center">{{$user->nick}}</td>
                        <td class="border-black border px-2 py-1 text-center max-w-4xl truncate">{{$user->avatar}}</td>
                        <td class="border-black border px-2 py-1 text-center max-w-4xl truncate">{{$user->motto}}</td>
                        <td class="border-black border px-2 py-1 text-center">{{$user->role}}</td>
                        <td class="border-black border px-2 py-1 text-center">{{$user->permission}}</td>
                        <td class="border-black border px-2 py-1 text-center"></td>
                        <td class="border-black border px-2 py-1 text-center"><a href="user/edit/{{$user->id}}" class="text-blue-500 hover:text-blue-700 hover:underline transition">Upravit</a></td>
                        <td class="border-black border px-2 py-1 text-center">{{$user->created_at}}</td>
                        <td class="border-black border px-2 py-1 text-center">{{$user->updated_at}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
@endsection
