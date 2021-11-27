@extends('layout')
@section('title', 'Kontakt')

@section('content')
    @include('page.navbar')
    <main class="" style="height: 2000px;">
        <section class="w-11/12 m-auto mt-10">
            <h3 class="inline w-full text-center m-10 text-4xl font-bold">Kontakt</h3>
            <p class="text-center mt-10">Pokud byste měli jakékoliv nápady, návrhy, připomínky nebo chtěli spolupracovat na tvorbě školního časopisu napiště nám na email:
                <a href="mailto:casopis@gymkrom.cz" class="underline text-blue-500 hover:text-blue-700 transition text-lg">casopis@gymkrom.cz</a></p>
        </section>
        <section class="w-11/12 m-auto flex flex-wrap justify-evenly mt-10">
            <h3 class="inline w-full text-center m-10 text-4xl font-bold">Náš tým</h3>
            @foreach($redaktors as $redaktor)
                <article class="w-96 m-3">
                    <div class="block w-full h-full filter drop-shadow-xl hover:drop-shadow-2xl">
                        <header class="w-full overflow-hidden relative z-20">
                            <img src="{{$redaktor->avatar?: '/img/profile-placeholder.jpg'}}" alt="Profilový obrázek" class="rounded-full w-36 m-auto border-none border-gray-400">
                        </header>
                        <main class="bg-white px-2 pb-2 pt-6 -mt-9 rounded-md border-2 border-gray-400">
                            @if ($redaktor->nickname)
                                <h4 class="font-bold pt-2 px-2 pb-1 text-lg">
                                    {{$redaktor->nickname}}
                                    <span class="font-normal"> ({{$redaktor->name}})</span>
                                </h4>
                            @else
                                <h4 class="font-bold pt-2 px-2 pb-1 text-lg">
                                    {{$redaktor->name}}
                                </h4>
                            @endif

                            <h5 class="font-semibold pt-2 px-2 pb-1 text-lg ">{{$redaktor->role}}</h5>
                            <p class="w-full px-2 block px-2 h-24 overflow-hidden">
                                {{$redaktor->motto}}
                            </p>
                        </main>
                    </div>
                </article>
            @endforeach
        </section>
    </main>
@endsection
