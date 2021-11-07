@extends('layout')
@section('title', 'Home - Administrace')

@section('content')
    <nav class="w-full h-20 bg-primary-dark-500 flex flex-col md:flex-row justify-between sticky -top-0.5 relative z-50" id="navbar">
        <div class="w-full md:w-1/3 h-full flex justify-between md:justify-start">
            <div class="flex pl-2 pr-4 hover:bg-primary-dark-300 transition">
                <img src="/img/logo.svg" class="w-20 h-20" alt="Logo">
                <h1 class="grid place-items-center ml-3 pb-1">
                    <span class="font-bold text-4xl text-text-light">
                        Administrace
                    </span>
                </h1>
            </div>
            <div class="self-center text-text-light md:hidden px-3 font-semibold text-2xl hamburger" id="hamburger" onclick="toggleMenu()">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>
        <div class="w-full md:w-2/3  md:h-full hidden md:flex flex-row items-start bg-primary-dark-400 md:bg-primary-dark-500 md:justify-end" id="menu">
            <a class="px-4 grid place-items-center h-20 pb-1 bg-primary-dark-300 transition">
                <span class="font-semibold text-2xl text-text-light">
                    Články
                </span>
            </a>
            <a class="px-4 grid place-items-center h-20 pb-1 hover:bg-primary-dark-300 transition">
                <span class="font-semibold text-2xl text-text-light">
                    Časopis
                </span>
            </a>
            <a class="px-4 grid place-items-center h-20 pb-1 hover:bg-primary-dark-300 transition">
                <span class="font-semibold text-2xl text-text-light">
                    Uživatelé
                </span>
            </a>
            <a class="px-4 grid place-items-center h-20 pb-1 hover:bg-primary-dark-300 transition">
                <span class="font-semibold text-2xl text-text-light">
                    Nastavení
                </span>
            </a>
        </div>
    </nav>
    <main class="" style="height: 2000px;">
        <a href="{{route('post.create')}}" class="text-blue-500 hover:text-blue-700 hover:underline transition block w-max mx-auto my-5">Přidat nový</a>
        <div class="p-2 w-full overflow-auto">
            <table class="table-fixed w-max mx-auto">
                <tr>
                    <th class="border-black border-2 px-2 py-1 text-center">#</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Název</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Krátký</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Text</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Tagy</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Redaktoři</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Editor</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Šéfredaktor</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Publikováno</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Publikovat</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Upravit</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Vytvořeno</th>
                    <th class="border-black border-2 px-2 py-1 text-center">Upraveno</th>
                </tr>
                @foreach($posts as $post)
                    <tr>
                        <td class="border-black border px-2 py-1 text-center">{{$post->id}}</td>
                        <td class="border-black border px-2 py-1 text-center">{{$post->name}}</td>
                        <td class="border-black border px-2 py-1 text-center">{{$post->short}}</td>
                        <td class="border-black border px-2 py-1 text-center max-w-4xl truncate">{{$post->text}}</td>
                        <td class="border-black border px-2 py-1 text-center">
                            @foreach($post->tags as $tag)
                                {{$tag->name}}
                            @endforeach
                        </td>
                        <td class="border-black border px-2 py-1 text-center">
                            @foreach($post->authors as $author)
                                {{$author->name}}
                            @endforeach
                        </td>
                        <td class="border-black border px-2 py-1 text-center">{{$post->editorname}}</td>
                        <td class="border-black border px-2 py-1 text-center">{{$post->chiefname}}</td>

                        @if ($post->published_at)
                            <td class="border-black border px-2 py-1 text-center">ANO ({{$post->published_at}})</td>
                            <td class="border-black border px-2 py-1 text-center"><a href="/post/publish/{{$post->id}}" class="text-red-500 hover:text-red-700 hover:underline transition">Stáhnout</a></td>
                        @else
                            <td class="border-black border px-2 py-1 text-center">NE</td>
                            @if ($post->completed && $post->editor_checked && $post->chief_checked)
                                <td class="border-black border px-2 py-1 text-center"><a href="/post/publish/{{$post->id}}" class="text-green-500 hover:text-green-700 hover:underline transition">Publikovat</a></td>
                            @else
                                <td class="border-black border px-2 py-1 text-center"><abbr class="text-gray-500" title="Nelze publikovat, protože nebyl dokončen nebo zkontrolován">Publikovat</abbr></td>
                            @endif

                        @endif

                        <td class="border-black border px-2 py-1 text-center"><a href="/post/edit/{{$post->id}}" class="text-blue-500 hover:text-blue-700 hover:underline transition">Upravit</a></td>
                        <td class="border-black border px-2 py-1 text-center">{{$post->created_at}}</td>
                        <td class="border-black border px-2 py-1 text-center">{{$post->updated_at}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    </main>
    <script>
        function toggleMenu() {
            document.getElementById('hamburger').classList.toggle("change");
            var menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        }
    </script>
@endsection
