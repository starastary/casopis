@extends('layout')
@section('title', 'Hlavní stránka')

@section('content')
    <header class="w-full h-screen bg-primary-dark-500 bg-img">
        <div class="w-full h-full bg-primary-dark-500 opacity-75">

        </div>
        <div class="absolute top-0 left-0 w-full h-screen z-20 flex flex-col lg:flex-row justify-evenly items-center">
            <article class="w-10/12 md:w-7/12 lg:w-5/12 xl:w-1/3 2xl:w-1/4 text-center lg:text-left">
                <h2 class="text-text-light font-bold text-6xl md:text-7xl lg:text-9xl">Tajemná komnata</h2>
                <p class="text-text-light font-semibold  text-sm md:text-base lg:text-2xl mt-6">„Většina lidí ve skutečnosti nechce svobodu, protože svoboda zahrnuje odpovědnost a většina lidí se bojí odpovědnosti.“ Zdroj: https://citaty.net/</p>
            </article>
            <article class="w-5/12 xl:w-1/3 2xl:w-1/4 text-center ">
                <h3 class="text-text-light font-semibold text-2xl md:text-4xl lg:text-5xl">Poslední díl:</h3>
                <p class="text-text-light text-xl md:text-2xl lg:text-3xl mt-3">10/21</p>
                <a href="#" class="block w-32 md:w-56 m-auto px-2 py-3 text-text-light font-semibold  text-lg md:text-2xl lg:text-3xl bg-secondary-dark-500 mt-6 shadow-xl hover:bg-secondary-dark-700 hover:shadow-2xl transition">Stahujte zde</a>
            </article>
        </div>
        <a href="#navbar" class=" absolute z-20 bottom-2 md:bottom-5 items-center left-1/2 flex flex-col transform -translate-x-1/2 text-4xl lg:text-6xl text-text-light opacity-75 hover:opacity-100 transition">
            <i class="fas fa-mouse"></i>
            <i class="fas fa-sort-down -mt-3 lg:-mt-5"></i>
        </a>

    </header>
    @include('page.navbar')
    <main class="" style="height: 2000px;">
        <section class="w-96 h-48 m-auto mt-10 shadow-2xl text-center p-4 relative bg-white border-2 border-gray-400">
            <h3 class="font-semibold text-xl">Citát týdne: </h3>
            <p class="pt-3">„Ať už si myslíte, že něco dokážete, nebo si myslíte, že to nedokážete, v obou případech máte pravdu.“
            <p class="absolute bottom-4 right-5">Autor: <span class="font-semibold">Henry Ford</span></p>
        </section>

        <section class="w-11/12 m-auto flex flex-wrap justify-evenly mt-10">
            <h3 class="inline w-full text-center m-10 text-4xl font-bold">Nejnovější články</h3>
                @foreach($posts as $post)
                <article class="w-96 m-3 shadow-xl hover:shadow-2xl transition border-2 border-gray-400">
                    <a href="{{route('post.show', $post->slug)}}" class="block w-full h-full">
                        <header class="w-full h-52 bg-primary-50 overflow-hidden">
                            <img src="{{$post->img}}" alt="Náhled článku">
                        </header>
                        <main>
                            <h4 class="font-semibold pt-2 px-2 pb-1 text-lg hover:underline transition">{{$post->name}}</h4>
                            <p class="w-full px-2">
                            <span class="block px-2 h-24 overflow-hidden">{{$post->short}}</span>
                                <span class="text-blue-500 hover:text-blue-700 hover:underline transition">Přečíst....</span>
                            </p>
                        </main>
                        <footer class="flex justify-between p-2">
                            <p>Autor:
                                @foreach($post->authors as $author)
                                    {{$author->name}}
                                @endforeach
                            </p>
                            <p>{{$post->updated_at->diffForHumans()}}</p>
                        </footer>
                    </a>
                </article>
                @endforeach


        </section>
    </main>
@endsection
