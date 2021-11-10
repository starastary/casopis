@extends('layout')
@section('title', $post->name)

@section('content')

    <header class="w-full relative" style="
        height: 220px;
        background-image: url('{{$post->img}}');
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

    <main class="p-3 text-holder m-auto max-w-7xl" style="height: 2000px;">
        {!! $post->textclear !!}
    </main>

@endsection
