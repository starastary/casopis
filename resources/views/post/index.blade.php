@extends('layout')
@section('title', 'Články')

@section('content')
    @include('page.navbar')
    <main class="" style="height: 2000px;">
        <section class="w-11/12 m-auto flex flex-wrap justify-evenly mt-10">
            <h3 class="inline w-full text-center m-10 text-4xl font-bold">Nejnovější články</h3>
            @foreach($posts as $post)
                @include('post.article')
            @endforeach
        </section>
    </main>
@endsection
