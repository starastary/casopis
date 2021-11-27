@extends('layout')
@section('title', 'Hlavní stránka')

@section('content')
    <header class="w-full h-screen bg-primary-dark-500 bg-img relative">
        <div class="w-full h-full bg-primary-dark-500 opacity-75">

        </div>
        <div class="absolute top-0 left-0 w-full h-screen z-20 flex flex-col lg:flex-row justify-evenly items-center">
                <article class="w-10/12 md:w-7/12 lg:w-5/12 xl:w-1/3 2xl:w-1/4 text-center lg:text-left">
                    <h2 class="text-text-light font-bold text-6xl md:text-7xl lg:text-9xl">Tajemná komnata</h2>
                    <!--<p class="text-text-light font-semibold  text-sm md:text-base lg:text-2xl mt-6">„Většina lidí ve skutečnosti nechce svobodu, protože svoboda zahrnuje odpovědnost a většina lidí se bojí odpovědnosti.“ Zdroj: https://citaty.net/</p>-->
                </article>
                <article class="w-5/12 xl:w-1/3 2xl:w-1/4 text-center">
                    @if ($magazine)
                        <h3 class="text-text-light font-semibold text-2xl md:text-4xl lg:text-5xl">Poslední díl:</h3>
                        <p class="text-text-light text-xl md:text-2xl lg:text-3xl mt-3">{{$magazine->name}}</p>
                        <a href="{{asset($magazine->file)}}" target="_blank" class="block w-32 md:w-56 m-auto px-2 py-3 text-text-light font-semibold  text-lg md:text-2xl lg:text-3xl bg-secondary-dark-500 mt-6 shadow-xl hover:bg-secondary-dark-700 hover:shadow-2xl transition">Stahujte zde</a>
                    @endif
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

        <section class="w-11/12 m-auto mt-20">
            <div class="m-auto flex flex-wrap justify-evenly">
                <h3 class="inline w-full text-center m-10 text-4xl font-bold">Nejnovější články</h3>
                    @foreach($posts as $post)
                        @include('post.article')
                    @endforeach
            </div>
            <a href="{{route('news')}}" class="block w-36 m-auto px-2 py-3 text-text-light font-semibold text-center text-white text-lg text-xl bg-secondary-dark-500 mt-6 shadow-xl hover:bg-secondary-dark-700 hover:shadow-2xl transition">Další články</a>
        </section>


        <section class="w-11/12 m-auto mt-20">
            <div class="m-auto flex flex-wrap justify-evenly">
                <h3 class="inline w-full text-center m-10 text-4xl font-bold">Naše časopisy</h3>
                    @foreach($magazines as $magazine)
                        @include('magazine.article')
                    @endforeach
            </div>
            <a href="{{route('magazine')}}" class="block w-36 m-auto px-2 py-3 text-text-light font-semibold text-center text-white text-lg text-xl bg-secondary-dark-500 mt-6 shadow-xl hover:bg-secondary-dark-700 hover:shadow-2xl transition">Další časopisy</a>
        </section>
    </main>
@endsection
