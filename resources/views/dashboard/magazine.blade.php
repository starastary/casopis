@extends('layout')
@section('title', 'Magazine - Administrace')

@section('content')
    @include('dashboard.navbar')
    <main class="" style="height: 2000px;">
        <a href="{{route('magazine.create')}}" class="text-blue-500 hover:text-blue-700 hover:underline transition block w-max mx-auto my-5">Přidat nový</a>
        <div class="p-2 w-full overflow-auto">
            <table class="table-fixed w-max mx-auto">
                <tr>
                    <th class="border-black border-2 px-2 py-1 text-center">#</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Název</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Popisek</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Náhledovka</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Soubor</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Autoři</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Editor</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Šéfredaktor</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Upravit</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Smazat</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Vytvořeno</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Upraveno</th>
                </tr>
                @foreach($magazines as $magazine)
                    <tr>
                        <td class="border-black border px-2 py-1 text-center">{{$magazine->id}}</td>
                        <td class="border-black border px-2 py-1 text-center">{{$magazine->name}}</td>
                        <td class="border-black border px-2 py-1 text-center max-w-4xl truncate">{{$magazine->motto}}</td>
                        <td class="border-black border px-2 py-1 text-center"><a href="{{$magazine->img}}" class="text-blue-500 hover:text-blue-700 hover:underline transition">{{$magazine->img}}</a></td>
                        <td class="border-black border px-2 py-1 text-center"><a href="{{$magazine->file}}" class="text-blue-500 hover:text-blue-700 hover:underline transition">{{$magazine->file}}</a></td>
                        <td class="border-black border px-2 py-1 text-center">{{$magazine->authors}}</td>
                        <td class="border-black border px-2 py-1 text-center">{{$magazine->editorname}}</td>
                        <td class="border-black border px-2 py-1 text-center">{{$magazine->chiefname}}</td>
                        <td class="border-black border px-2 py-1 text-center"><a href="/magazine/edit/{{$magazine->id}}" class="text-blue-500 hover:text-blue-700 hover:underline transition">Upravit</a></td>
                        <td class="border-black border px-2 py-1 text-center"><a href="/magazine/delete/{{$magazine->id}}" class="text-red-500 hover:text-red-700 hover:underline transition">Smazat</a></td>
                        <td class="border-black border px-2 py-1 text-center">{{$magazine->created_at}}</td>
                        <td class="border-black border px-2 py-1 text-center">{{$magazine->updated_at}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
@endsection
