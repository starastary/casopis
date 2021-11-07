
@extends('layout')
@section('title', 'Login')
@section('content')
    <div class="" style="display: grid; place-content: center; width: 100%; height: 100vh">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="card p-3 m-auto" style="width: 25rem;">
        @csrf

        <!-- Email Address -->
            <div class="flex flex-col lg:flex-row w-full items-center justify-between lg:mt-8">
                <div class="flex flex-col justify-start mx-6 w-full  mt-2">
                    <label for="email" class="text-2xl mb-2">Email:</label>
                    <input id="email" class="rounded-lg px-5 py-3 text-lg border border-primary-700" type="text" name="email" value="{{old('name')}}" required autofocus />
                </div>
            </div>

            <!-- Password -->
            <div class="flex flex-col lg:flex-row w-full items-center justify-between lg:mt-8">
                <div class="flex flex-col justify-start mx-6 w-full mt-2">
                    <label for="password" class="text-2xl mb-2">Heslo:</label>
                    <input id="password" class="rounded-lg px-5 py-3 text-lg border-primary-700 border border-primary-700"
                           type="password"
                           name="password"
                           required autocomplete="current-password" />
                </div>
            </div>

            <button type="submit" class="block m-auto uppercase font-bold text-2xl text-white mt-10 py-4 px-16 bg-green-500 rounded-lg shadow-lg hover:shadow-2xl hover:bg-green-600 transition">
                Přihlásit
            </button>
            <a href="{{route('home')}}" class="mt-5 underline text-gray-500 hover:text-gray-700 m-auto block w-max">Zpět</a>
        </form>
    </div>
@endsection
