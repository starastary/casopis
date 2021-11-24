@extends('layout')

@section('title', 'Nový časopis')

@section('content')
    <script src="https://cdn.tiny.cloud/1/bys1ly30gpwdd8jb5i9lt4ro2avsfnxmn1em00cbt3baqbun/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <div class="" style="display: grid; place-content: center;width: 100%; min-height: 100vh">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/magazine" class="w-screen" enctype="multipart/form-data">
        @csrf
        <div class="p-3">

            <div class="p-3 flex flex-col md:flex-row">
                <!-- Název -->
                <div class="flex flex-col lg:flex-row w-full items-center justify-between lg:mt-8 m-2">
                    <div class="flex flex-col justify-start mx-6 w-full  mt-2">
                        <label for="name" class="text-2xl mb-2">Název:</label>
                        <input id="name" class="rounded-lg px-5 py-3 text-lg border border-primary-700" type="text" name="name" value="{{old('name')}}" required autofocus />
                    </div>
                </div>

                <!-- Náhledovka -->
                <div class="flex flex-col lg:flex-row w-full items-center justify-between lg:mt-8 m-2">
                    <div class="flex flex-col justify-start mx-6 w-full  mt-2">
                        <label for="img" class="text-2xl mb-2">Náhledový obrázek:</label>
                        <input type="file" id="img" name="img" value="{{old('img')}}"
                               accept=".png,.jpg">
                    </div>
                </div>
            </div>

            <div class="p-3 flex flex-col md:flex-row md:items-center">
                <!-- Krátký -->
                <div class="flex flex-col lg:flex-row w-full items-center justify-between lg:mt-8 m-2">
                    <div class="flex flex-col justify-start mx-6 w-full  mt-2">
                        <label for="motto" class="text-2xl mb-2">Popisek:</label>
                        <input id="motto" class="rounded-lg px-5 py-3 text-lg border border-primary-700" type="text" name="motto" value="{{old('motto')}}" />
                    </div>
                </div>

                <!-- Soubor -->
                <div class="w-full flex flex-col">
                    <label for="file" class="text-2xl mb-2">Soubor:</label>
                    <input type="file" id="file" name="file" value="{{old('file')}}"
                           accept=".pdf">
                </div>
        </div>

        <button type="submit" class="block m-auto uppercase font-bold text-2xl text-white mt-10 py-4 px-16 bg-green-500 rounded-lg shadow-lg hover:shadow-2xl hover:bg-green-600 transition">
            Vytvořit
        </button>
            <a href="{{route('dashboard/magazine')}}" class="mt-5 underline text-gray-500 hover:text-gray-700 m-auto block w-max">Zpět</a>
        </form>

    </div>
@endsection
