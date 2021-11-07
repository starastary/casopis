@extends('layout')
@section('title', 'Hlavní stránka')

@section('content')
    <nav class="w-full h-20 bg-primary-dark-500 flex flex-col md:flex-row justify-between sticky -top-0.5 relative z-50" id="navbar">
        <div class="w-full md:w-1/3 h-full flex justify-between md:justify-start">
            <div class="flex pl-2 pr-4 hover:bg-primary-dark-300 transition">
                <img src="../public/img/logo.svg" class="w-20 h-20" alt="Logo">
                <h1 class="grid place-items-center ml-3 pb-1">
                    <span class="font-bold text-4xl text-text-light">
                        Název
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
                    Domů
                </span>
            </a>
            <a class="px-4 grid place-items-center h-20 pb-1 hover:bg-primary-dark-300 transition">
                <span class="font-semibold text-2xl text-text-light">
                    Novinky
                </span>
            </a>
            <a class="px-4 grid place-items-center h-20 pb-1 hover:bg-primary-dark-300 transition">
                <span class="font-semibold text-2xl text-text-light">
                    Náš Tým
                </span>
            </a>
            <a class="px-4 grid place-items-center h-20 pb-1 hover:bg-primary-dark-300 transition">
                <span class="font-semibold text-2xl text-text-light">
                    Kontakt
                </span>
            </a>
        </div>
    </nav>

    <header class="w-full p-3">
        <h3 class="font-bold text-3xl">
            {{$post->name}}
        </h3>
    </header>

    <main class="p-2" style="height: 2000px;">
        {!! $post->textclear !!}
    </main>
    <script>
        function toggleMenu() {
            document.getElementById('hamburger').classList.toggle("change");
            var menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        }
    </script>
@endsection
