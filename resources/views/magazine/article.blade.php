<article class="w-96 m-3 shadow-xl hover:shadow-2xl transition border-2 border-gray-400">
    <a href="{{asset($magazine->file)}}" class="block w-full h-full">
        <header class="w-full h-52 bg-primary-50 overflow-hidden">
            <img src="{{asset($magazine->img) ?: asset('img/post-placeholder.jpg')}}" alt="Náhled článku">
        </header>
        <main>
            <h4 class="font-semibold pt-2 px-2 pb-1 text-lg hover:underline transition">{{$magazine->name}}</h4>
            <p class="w-full px-2">
                <span class="block px-2 h-24 overflow-hidden">{{$magazine->motto}}</span>
                <span class="text-blue-500 hover:text-blue-700 hover:underline transition">Přečíst....</span>
            </p>
        </main>
        <footer class="flex justify-between p-2">
            <p>{{$magazine->updated_at->diffForHumans()}}</p>
        </footer>
    </a>
</article>
