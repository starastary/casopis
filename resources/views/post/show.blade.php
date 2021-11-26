@extends('layout')
@section('title', $post->name)

@section('content')

    <header class="w-full relative" style="
        height: 220px;
        background-image: url('{{asset($post->img) ?: asset('img/post-placeholder.jpg')}}');
        background-repeat: no-repeat;
        background-size: auto 100%;
        background-attachment: fixed;
        background-position: center center;
        ">
        <div class="w-full h-full flex flex-col items-start justify-center p-3" style="background: rgba(26,32,44,0.75)">
            <h3 class="font-bold text-3xl text-white">
                {{$post->name}}
            </h3>
            <p class="mt-5 ml-2 text-white text-lg">
                {{$post->short}}
            </p>
        </div>

        <div class="absolute bottom-5 left-5 flex">
            @foreach($post->tags as $tag)
                <p class="ml-1 px-1 py-0.5 bg-primary-800 text-white text-lg rounded hover:bg-primary-600 cursor-pointer transition">{{$tag->name}}</p>
            @endforeach
        </div>
    </header>

    <main class="lg:flex justify-evenly lg:items-start m-auto max-w-7xl" style="height: 2000px;">
        <div class="p-3 w-11/12 m-auto my-4 lg:w-8/12 text-holder">
            {!! $post->textclear !!}
        </div>
        <aside class="p-3 w-max h-max m-auto my-4 lg:w-4/12 text-left lg:border-gray-400 border-2">
            @if (count($post->authors) > 1)
                <p class="font-bold">Autoři:</p>
            @else
                <p class="font-bold">Autor:</p>
            @endif
            @foreach($post->authors as $author)
                <p class="pl-2">{{$author->name}}</p>
            @endforeach
            <p class="font-bold">Editor:</p>
            <p  class="pl-2">{{$post->editorname}}</p>
            <p class="font-bold">Šéf redaktor:</p>
            <p  class="pl-2">{{$post->chiefname}}</p>
            <p class="font-bold">Vydáno:</p>
            <p  class="pl-2">{{$post->published_at}}</p>
        </aside>
    </main>

@endsection
